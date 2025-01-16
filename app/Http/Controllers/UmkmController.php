<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUmkmRequest;
use App\Http\Requests\UpdateUmkmRequest;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\ModelSocialMedia;
use App\Models\Product;
use App\Models\SocialMedia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('super-admin')) {
            $umkms = Umkm::paginate(10);
            return view('dashboard.umkms.index', compact('umkms'));
        } else if ($user->can('view-umkms')) {
            $umkm = $user->umkm;
            return view('dashboard.umkms.show', compact('umkm'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        /** @var \User $user */
        $user = Auth::user();
        if (!$user->can('create-umkms') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat umkm.');
        }

        return view('dashboard.umkms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUmkmRequest $request)
    {
        //
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('create-umkms') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat destinasi.');
        }

        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $userSlug = $this->generateUniqueSlugUser($validatedData['user_name']);
            $user = User::create([
                'name' => $validatedData['user_name'],
                'email' => $validatedData['user_email'],
                'phone' => $validatedData['user_phone'],
                'slug' => $userSlug,
                'password' => Hash::make($validatedData['password']),
            ]);

            $user->assignRole('umkm');

            $umkmSlug = $this->generateUniqueSlugUmkm($validatedData['umkm_name']);

            Umkm::create([
                'user_id' => $user->id,
                'name' => $validatedData['umkm_name'],
                'description' => $validatedData['umkm_description'],
                'address' => $validatedData['umkm_address'],
                'slug' => $umkmSlug,
                'status' => 'draft',
            ]);

            DB::commit();

            return redirect()->route('umkms.index')
                ->with('success', 'Destination owner dan data destinasi berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating destination: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Umkm $umkm)
    {
        //
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk melihat UMKM ini.');
        }

        return view('dashboard.umkms.show', compact('umkm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Umkm $umkm)
    {
        //

        /** @var \User $user */
        $user = Auth::user();
        if (!$user->can('edit-umkms') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah umkm.');
        }

        return view('dashboard.umkms.edit', compact('umkm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUmkmRequest $request, Umkm $umkm)
    {
        //
        /** @var \User $user */
        $user = Auth::user();
        if (!$user->can('edit-umkms') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah umkm.');
        }
        $validatedData = $request->validated();
        try {
            DB::beginTransaction();

            $userSlug = $this->generateUniqueSlugUser($validatedData['user_name']);

            $umkm->user->update([
                'name' => $validatedData['user_name'],
                'phone' => $validatedData['user_phone'],
                'slug' => $userSlug,
            ]);

            if ($validatedData['password']) {
                $umkm->user->update([
                    'password' => Hash::make($validatedData['password']),
                ]);
            }

            $umkmSlug = $this->generateUniqueSlugUmkm($validatedData['umkm_name']);

            $umkm->update([
                'name' => $validatedData['umkm_name'],
                'description' => $validatedData['umkm_description'],
                'address' => $validatedData['umkm_address'],
                'slug' => $umkmSlug,
            ]);

            DB::commit();

            return redirect()->route('umkms.index')
                ->with('success', 'Data umkm berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating umkm: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Umkm $umkm)
    {
        //
    }

    public function editAdmin()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->hasPermissionTo('edit-umkms')) {
            $umkm = $user->umkm;
            $umkm->load('user', 'socialMedia');
            $socialMediaPlatforms = SocialMedia::all();
            return view('dashboard.umkms.editAdmin', compact(
                'umkm',
                'socialMediaPlatforms'

            ));
        }
    }

    public function updateAdmin(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasPermissionTo('edit-umkms')) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah UMKM ini.');
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'phone' => 'nullable|string',
            'thumbnail' => 'nullable|image',
        ]);
        DB::beginTransaction();
        try {
            $umkm = $user->umkm;
            $slug = $this->generateUniqueSlugUmkm($validatedData['name']);
            $imageName = $umkm->thumbnail;
            if ($request->hasFile('thumbnail')) {
                if ($umkm->thumbnail) {
                    Storage::disk('public')->delete('images/umkms/' . $umkm->thumbnail);
                }
                $image = $request->file('thumbnail');
                $extension = $image->getClientOriginalExtension();
                $imageName = "{$slug}.{$extension}";
                $image->storeAs('images/umkms', $imageName, 'public');
            }
            $umkm->update([
                'name' => $validatedData['name'],
                'address' => $validatedData['address'],
                'description' => $validatedData['description'],
                'slug' => $slug,
                'phone' => $validatedData['phone'],
                'thumbnail' => $imageName,
            ]);

            DB::commit();
            return redirect()->route('umkms.index')->with('success', 'Data UMKM berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating UMKM: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function createProduct()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->hasPermissionTo('create-products')) {
            $categories = Category::all();
            $umkm = $user->umkm;
            return view('dashboard.umkms.products.create', compact(
                'categories',
            ));
        }
    }

    public function storeProduct(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasPermissionTo('create-products')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat produk.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'thumbnail' => 'nullable|image',
            'galleries' => 'nullable|array',
            'galleries.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        DB::beginTransaction();
        try {
            $umkm = $user->umkm;
            $slug = $this->generateUniqueSlugProduct($validatedData['name']);
            $imageName = null;
            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $extension = $image->getClientOriginalExtension();
                $imageName = "{$slug}.{$extension}";
                $image->storeAs('images/products', $imageName, 'public');
            }
            $product = $umkm->products()->create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'category_id' => $validatedData['category_id'],
                'thumbnail' => $imageName,
                'slug' => $slug,
            ]);

            if ($request->hasFile('galleries')) {
                $galleries = $request->file('galleries');
                foreach ($galleries as $gallery) {
                    $extension = $gallery->getClientOriginalExtension();
                    $galleryName = Str::random(8) . ".{$extension}";
                    $gallery->storeAs('images/products', $galleryName, 'public');
                    $product->galleries()->create([
                        'path' => $galleryName,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('umkms.index')->with('success', 'Produk berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating product: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function editProduct(String $slug)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->hasPermissionTo('edit-products')) {
            $categories = Category::all();
            $umkm = $user->umkm;
            $product = Product::where('slug', $slug)->first();
            return view('dashboard.umkms.products.edit', compact(
                'categories',
                'product',
            ));
        }
    }

    public function updateProduct(Request $request, Product $product)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasPermissionTo('edit-products')) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah produk.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|string|in:draft,published,archived',
            'thumbnail' => 'nullable|image',
            'galleries' => 'nullable|array',
            'galleries.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        DB::beginTransaction();

        try {
            $slug = $this->generateUniqueSlugProduct($validatedData['name']);
            $imageName = $product->thumbnail;
            if ($request->hasFile('thumbnail')) {
                if ($product->thumbnail) {
                    Storage::disk('public')->delete('images/products/' . $product->thumbnail);
                }
                $image = $request->file('thumbnail');
                $extension = $image->getClientOriginalExtension();
                $imageName = "{$slug}.{$extension}";
                $image->storeAs('images/products', $imageName, 'public');
            }

            $product->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'category_id' => $validatedData['category_id'],
                'thumbnail' => $imageName,
                'slug' => $slug,
                'status' => $validatedData['status'],
            ]);

            if ($request->hasFile('galleries')) {
                $galleries = $request->file('galleries');
                foreach ($galleries as $gallery) {
                    $extension = $gallery->getClientOriginalExtension();
                    $galleryName = Str::random(8) . ".{$extension}";
                    $gallery->storeAs('images/products', $galleryName, 'public');
                    $product->galleries()->create([
                        'path' => $galleryName,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('umkms.index')->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating product: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function showProduct(String $slug)
    {
        /** @var User $user */
        $user = Auth::user();
        $product = Product::where('slug', $slug)->firstOrFail();
        if ($user->can('view-products') && $user->umkm->id === $product->umkm_id) {
            return view('dashboard.umkms.products.show', compact('product'));
        }
        abort(403, 'Anda tidak memiliki akses untuk melihat produk ini.');
    }

    public function createSocialMedia()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->hasPermissionTo('create-social_media')) {
            $socialMediaPlatforms = SocialMedia::all();
            return view('dashboard.umkms.socialMedia.create', compact('socialMediaPlatforms'));
        }
    }

    public function storeSocialMedia(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasPermissionTo('create-social_media')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat media sosial.');
        }

        $validatedData = $request->validate([
            'platform' => 'required|exists:social_media,id', // Changed from social_media_id to match form
            'url' => 'required|url',
            'username' => 'nullable|string|max:255',
        ]);

        try {
            $umkm = $user->umkm;
            $umkm->socialMedia()->create([
                'social_media_id' => $validatedData['platform'],
                'url' => $validatedData['url'],
                'username' => $validatedData['username'],
            ]);
            return redirect()->route('umkms.index')->with('success', 'Media sosial berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error creating social media: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function editSocialMedia(ModelSocialMedia $socialMedia)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasPermissionTo('edit-social_media')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit media sosial.');
        }

        $socialMediaPlatforms = SocialMedia::all();
        return view('dashboard.umkms.socialMedia.edit', compact(
            'socialMediaPlatforms',
            'socialMedia'
        ));
    }

    public function updateSocialMedia(Request $request, ModelSocialMedia $modelSocialMedia)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasPermissionTo('edit-social_media')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit media sosial.');
        }

        $validatedData = $request->validate([
            'platform' => 'required|exists:social_media,id', // Changed from social_media_id to match form
            'url' => 'required|url',
            'username' => 'nullable|string|max:255',
        ]);

        dd($validatedData);

        try {
            $modelSocialMedia->update([
                'social_media_id' => $validatedData['platform'],
                'url' => $validatedData['url'],
                'username' => $validatedData['username'],
            ]);

            return redirect()->route('umkms.index')->with('success', 'Media sosial berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating social media: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }


    public function destroyGallery(Gallery $gallery)
    {
        try {
            // Delete the file from storage
            Storage::delete('public/images/products/' . $gallery->path);

            // Delete the gallery record
            $gallery->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error deleting gallery: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menghapus galeri.'], 500);
        }
    }

    private function generateUniqueSlugUmkm(String $name)
    {
        $baseSlug = Str::slug($name);
        $randomString = Str::random(8);
        $slug = $baseSlug . '-' . $randomString;
        $count = 1;

        while (Umkm::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $randomString . '-' . $count;
            $count++;
        }

        return $slug;
    }
    private function generateUniqueSlugUser($name)
    {
        $baseSlug = Str::slug($name);
        $randomString = Str::random(8);
        $slug = $baseSlug . '-' . $randomString;
        $count = 1;

        while (User::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $randomString . '-' . $count;
            $count++;
        }

        return $slug;
    }

    private function generateUniqueSlugProduct(String $name)
    {
        $baseSlug = Str::slug($name);
        $randomString = Str::random(8);
        $slug = $baseSlug . '-' . $randomString;
        $count = 1;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $randomString . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
