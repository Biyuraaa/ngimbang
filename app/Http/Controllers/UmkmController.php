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
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk melihat daftar UMKM.');
        }
        $umkms = Umkm::paginate(10);
        return view('dashboard.umkms.index', compact('umkms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        /** @var \User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
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
        $validatedData = $request->validated();
        try {
            DB::beginTransaction();


            $slug = $this->generateUniqueSlug($validatedData['name']);

            $imageName = null;
            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $extension = $image->getClientOriginalExtension();
                $imageName = "{$slug}.{$extension}";
                $image->storeAs('images/umkms', $imageName, 'public');
            }

            Umkm::create([
                'name' => $validatedData['name'],
                'owner' => $validatedData['owner'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'description' => $validatedData['description'],
                'address' => $validatedData['address'],
                'thumbnail' => $imageName,
                'slug' => $slug,
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
        if (!$user->hasRole('admin')) {
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
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah umkm.');
        }

        return view('dashboard.umkms.edit', compact('umkm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUmkmRequest $request, Umkm $umkm)
    {
        $validatedData = $request->validated();
        try {
            DB::beginTransaction();


            $slug = $this->generateUniqueSlug($validatedData['name']);

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
                'owner' => $validatedData['owner'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'description' => $validatedData['description'],
                'address' => $validatedData['address'],
                'thumbnail' => $imageName,
                'slug' => $slug,
            ]);

            DB::commit();

            return redirect()->route('umkms.show', $umkm)
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
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus UMKM ini.');
        }

        try {
            if ($umkm->thumbnail) {
                Storage::disk('public')->delete('images/umkms/' . $umkm->thumbnail);
            }

            foreach ($umkm->products as $product) {
                if ($product->thumbnail) {
                    Storage::disk('public')->delete('images/products/' . $product->thumbnail);
                }
                foreach ($product->galleries as $gallery) {
                    Storage::disk('public')->delete('images/products/' . $gallery->path);
                }
                $product->galleries()->delete();
            }

            $umkm->products()->delete();
            $umkm->socialMedia()->delete();
            $umkm->delete();

            return redirect()->route('umkms.index')
                ->with('success', 'UMKM berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting UMKM: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus UMKM.');
        }
    }

    public function createProduct(Umkm $umkm)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat produk.');
        }
        $categories = Category::all();
        return view('dashboard.umkms.products.create', compact(
            'umkm',
            'categories',
        ));
    }

    public function storeProduct(Request $request, Umkm $umkm)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat produk.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'thumbnail' => 'nullable|image',
        ]);
        DB::beginTransaction();
        try {
            $slug = $this->generateUniqueSlugProduct($validatedData['name']);
            $imageName = null;
            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $extension = $image->getClientOriginalExtension();
                $imageName = "{$slug}.{$extension}";
                $image->storeAs('images/products', $imageName, 'public');
            }
            $umkm->products()->create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'category_id' => $validatedData['category_id'],
                'thumbnail' => $imageName,
                'slug' => $slug,
            ]);

            DB::commit();
            return redirect()->route('umkms.show', $umkm)->with('success', 'Produk berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating product: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function editProduct(Umkm $umkm, Product $product)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah produk.');
        }
        $categories = Category::all();
        return view('dashboard.umkms.products.edit', compact(
            'categories',
            'umkm',
            'product',
        ));
    }

    public function updateProduct(Request $request, Umkm $umkm, Product $product)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah produk.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|string|in:draft,published,archived',
            'thumbnail' => 'nullable|image',
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
            return redirect()->route('umkms.show', $umkm)->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating product: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function showProduct(Umkm $umkm, Product $product)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki akses untuk melihat produk ini.');
        }
        return view('dashboard.umkms.products.show', compact(
            'umkm',
            'product'
        ));
    }

    public function destroyProduct(Umkm $umkm, Product $product)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus produk ini.');
        }

        try {
            if ($product->thumbnail) {
                Storage::disk('public')->delete('images/products/' . $product->thumbnail);
            }
            $product->delete();
            return redirect()->route('umkms.show', $umkm)->with('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus produk.');
        }
    }

    public function createSocialMedia(Umkm $umkm)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat media sosial.');
        }
        $socialMediaPlatforms = SocialMedia::all();
        return view('dashboard.umkms.socialMedia.create', compact(
            'socialMediaPlatforms',
            'umkm'
        ));
    }

    public function storeSocialMedia(Request $request, Umkm $umkm)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat media sosial.');
        }

        $validatedData = $request->validate([
            'social_media_id' => 'required|exists:social_media,id',
            'url' => 'required|url',
            'username' => 'nullable|string|max:255',
        ]);

        try {
            $umkm->socialMedia()->create([
                'social_media_id' => $validatedData['social_media_id'],
                'url' => $validatedData['url'],
                'username' => $validatedData['username'],
            ]);
            return redirect()->route('umkms.show', $umkm)->with('success', 'Media sosial berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error creating social media: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function editSocialMedia(Umkm $umkm, ModelSocialMedia $modelSocialMedia)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit media sosial.');
        }
        $socialMediaPlatforms = SocialMedia::all();
        return view('dashboard.umkms.socialMedia.edit', compact(
            'socialMediaPlatforms',
            'modelSocialMedia',
            'umkm'
        ));
    }

    public function updateSocialMedia(Request $request, Umkm $umkm, ModelSocialMedia $modelSocialMedia)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit media sosial.');
        }

        $validatedData = $request->validate([
            'social_media_id' => 'required|exists:social_media,id',
            'url' => 'required|url',
            'username' => 'nullable|string|max:255',
        ]);

        try {
            $modelSocialMedia->update([
                'social_media_id' => $validatedData['social_media_id'],
                'url' => $validatedData['url'],
                'username' => $validatedData['username'],
            ]);

            return redirect()->route('umkms.show', $umkm)->with('success', 'Media sosial berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating social media: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destroySocialMedia(Umkm $umkm, ModelSocialMedia $modelSocialMedia)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus media sosial.');
        }

        try {
            $modelSocialMedia->delete();
            return redirect()->route('umkms.show', $umkm)->with('success', 'Media sosial berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting social media: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus media sosial.');
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

    public function createProductSocialMedia(Umkm $umkm, Product $product)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat media sosial produk.');
        }
        $socialMediaPlatforms = SocialMedia::all();
        return view('dashboard.umkms.products.socialMedia.create', compact(
            'socialMediaPlatforms',
            'umkm',
            'product'
        ));
    }

    public function storeProductSocialMedia(Request $request, Umkm $umkm, Product $product)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat media sosial produk.');
        }

        $validatedData = $request->validate([
            'social_media_id' => 'required|exists:social_media,id',
            'url' => 'required|url',
            'username' => 'nullable|string|max:255',
        ]);

        try {
            $product->socialMedia()->create([
                'social_media_id' => $validatedData['social_media_id'],
                'url' => $validatedData['url'],
                'username' => $validatedData['username'],
            ]);
            return redirect()->route('umkms.products.show', [$umkm, $product])->with('success', 'Media sosial produk berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error creating product social media: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function editProductSocialMedia(Umkm $umkm, Product $product, ModelSocialMedia $modelSocialMedia)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit media sosial produk.');
        }
        $socialMediaPlatforms = SocialMedia::all();
        return view('dashboard.umkms.products.socialMedia.edit', compact(
            'socialMediaPlatforms',
            'modelSocialMedia',
            'umkm',
            'product'
        ));
    }

    public function updateProductSocialMedia(Request $request, Umkm $umkm, Product $product, ModelSocialMedia $modelSocialMedia)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit media sosial produk.');
        }

        $validatedData = $request->validate([
            'social_media_id' => 'required|exists:social_media,id',
            'url' => 'required|url',
            'username' => 'nullable|string|max:255',
        ]);

        try {
            $modelSocialMedia->update([
                'social_media_id' => $validatedData['social_media_id'],
                'url' => $validatedData['url'],
                'username' => $validatedData['username'],
            ]);

            return redirect()->route('umkms.products.show', [$umkm, $product])->with('success', 'Media sosial produk berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating product social media: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    private function generateUniqueSlug(String $name)
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
