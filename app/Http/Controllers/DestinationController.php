<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinationRequest;
use App\Http\Requests\UpdateDestinationRequest;
use App\Models\Attraction;
use App\Models\DestinationPriceRule;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\PriceRuleType;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk melihat destinasi.');
        }
        $destinations = Destination::paginate(10);
        return view('dashboard.destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat destinasi.');
        }
        return view('dashboard.destinations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDestinationRequest $request)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $slug = $this->generateUniqueSlug($validatedData['name']);

            $imageName = null;
            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $extension = $image->getClientOriginalExtension();
                $imageName = "{$slug}.{$extension}";
                $image->storeAs('images/destinations', $imageName, 'public');
            }

            Destination::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'slug' => $slug,
                'email' => $validatedData['email'],
                'address' => $validatedData['address'],
                'open_at' => $validatedData['open_at'],
                'close_at' => $validatedData['close_at'],
                'thumbnail' => $imageName,
                'phone' => $validatedData['phone'],
                'status' => $validatedData['status'],
            ]);

            DB::commit();

            return redirect()->route('destinations.index')
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
    public function show(Destination $destination)
    {
        //
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk melihat destinasi ini.');
        }
        $destination->load('comments', 'ratings');
        return view('dashboard.destinations.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        //
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit destinasi.');
        }
        return view('dashboard.destinations.edit', compact(
            'destination',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDestinationRequest $request, Destination $destination)
    {
        //
        $validatedData = $request->validated();
        try {
            $imageName = $destination->thumbnail;
            $slug = $this->generateUniqueSlug($validatedData['name']);
            if ($request->hasFile('thumbnail')) {
                if ($destination->thumbnail) {
                    Storage::disk('public')->delete('images/destinations/' . $destination->thumbnail);
                }
                $image = $request->file('thumbnail');
                $extension = $image->getClientOriginalExtension();
                $imageName = "{$slug}.{$extension}";
                $image->storeAs('images/destinations', $imageName, 'public');
            }
            $destination->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'slug' => $slug,
                'address' => $validatedData['address'],
                'open_at' => $validatedData['open_at'],
                'close_at' => $validatedData['close_at'],
                'thumbnail' => $imageName,
            ]);
            return redirect()->route('destinations.show', $destination)
                ->with('success', 'Data destinasi berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating destination: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        //
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus destinasi.');
        }

        try {
            if ($destination->thumbnail) {
                Storage::disk('public')->delete('images/destinations/' . $destination->thumbnail);
            }
            if ($destination->galleries) {
                foreach ($destination->galleries as $gallery) {
                    Storage::disk('public')->delete('images/destinations/galleries/' . $gallery->path);
                }
            }

            $destination->facilities()->delete();
            $destination->attractions()->delete();
            $destination->destinationPriceRules()->delete();
            $destination->galleries()->delete();
            $destination->socialMedia()->delete();
            $destination->delete();
            return redirect()->route('destinations.index')
                ->with('success', 'Blog berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus blog.');
        }
    }

    private function generateUniqueSlug($name)
    {
        $baseSlug = Str::slug($name);
        $randomString = Str::random(8);
        $slug = $baseSlug . '-' . $randomString;
        $count = 1;

        while (Destination::where('slug', $slug)->exists()) {
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

    public function destinationPriceCreate(Destination $destination)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses destinasi ini.');
        }
        $priceRuleTypes = PriceRuleType::whereNotIn('id', function ($query) use ($destination) {
            $query->select('price_rule_type_id')
                ->from('destination_price_rules')
                ->where('destination_id', $destination->id);
        })->get();
        return view('dashboard.destinations.prices.create', compact(
            'priceRuleTypes',
            'destination'
        ));
    }

    public function destinationPriceStore(Request $request, Destination $destination)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat destinasi.');
        }

        $request->validate([
            'price_rule_type_id' => 'required|exists:price_rule_types,id',
            'price' => 'required|numeric',
        ]);

        try {
            $destination->destinationPriceRules()->create([
                'price_rule_type_id' => $request->price_rule_type_id,
                'price' => $request->price,
                'status' => 'active',
            ]);

            return redirect()->route('destinations.show', $destination)
                ->with('success', 'Harga berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error creating destination price: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destinationPriceEdit(Destination $destination, DestinationPriceRule $destinationPriceRule)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit harga.');
        }
        $priceRuleTypes = PriceRuleType::where('id', $destinationPriceRule->price_rule_type_id)
            ->orWhereNotIn('id', function ($query) use ($destination) {
                $query->select('price_rule_type_id')
                    ->from('destination_price_rules')
                    ->where('destination_id', $destination->id);
            })->get();
        return view('dashboard.destinations.prices.edit', compact(
            'destination',
            'destinationPriceRule',
            'priceRuleTypes',
        ));
    }

    public function destinationPriceUpdate(Request $request, Destination $destination, DestinationPriceRule $destinationPriceRule)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit harga.');
        }

        $request->validate([
            'price_rule_type_id' => 'required|exists:price_rule_types,id',
            'price' => 'required|numeric',
        ]);

        try {
            $destinationPriceRule->update([
                'price_rule_type_id' => $request->price_rule_type_id,
                'price' => $request->price,
            ]);

            return redirect()->route('destinations.show', $destination)
                ->with('success', 'Harga berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating destination price: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destinationPriceDestroy(Destination $destination, DestinationPriceRule $destinationPriceRule)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus harga.');
        }

        try {
            $destinationPriceRule->delete();
            return redirect()->route('destinations.show', $destination)
                ->with('success', 'Harga berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting destination price: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }

    public function destinationAttractionCreate(Destination $destination)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat wahana.');
        }
        return view('dashboard.destinations.attractions.create', compact(
            'destination'
        ));
    }

    public function destinationAttractionStore(Request $request, Destination $destination)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat wahana.');
        }

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'nullable|numeric| min:0',
            'thumbnail' => 'nullable|image',
        ]);

        try {
            $imageName = null;
            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $extension = $image->getClientOriginalExtension();
                $imageName = Str::slug($request->name) . '.' . $extension;
                $image->storeAs('images/destinations/attractions', $imageName, 'public');
            }
            $destination->attractions()->create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'thumbnail' => $imageName,
            ]);

            return redirect()->route('destinations.show', $destination)
                ->with('success', 'Wisata berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error creating destination attraction: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destinationAttractionEdit(Destination $destination, Attraction $attraction)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit wisata.');
        }

        return view('dashboard.destinations.attractions.edit', compact(
            'attraction',
            'destination'
        ));
    }

    public function destinationAttractionUpdate(Request $request, Destination $destination,  Attraction $attraction)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit wisata.');
        }

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'nullable|numeric| min:0',
            'thumbnail' => 'nullable|image',
        ]);

        try {
            $attraction->update($request->only('name', 'description', 'price'));
            if ($request->hasFile('thumbnail')) {
                if ($attraction->thumbnail) {
                    Storage::disk('public')->delete('images/destinations/attractions/' . $attraction->thumbnail);
                }
                $image = $request->file('thumbnail');
                $extension = $image->getClientOriginalExtension();
                $imageName = Str::slug($request->name) . '.' . $extension;
                $image->storeAs('images/destinations/attractions', $imageName, 'public');
                $attraction->update(['thumbnail' => $imageName]);
            }

            return redirect()->route('destinations.show', $destination)
                ->with('success', 'Wisata berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating destination attraction: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destinationAttractionDestroy(Destination $destination, Attraction $attraction)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus wisata.');
        }

        try {
            if ($attraction->thumbnail) {
                Storage::disk('public')->delete('images/destinations/attractions/' . $attraction->thumbnail);
            }
            $attraction->delete();
            return redirect()->route('destinations.show', $destination)
                ->with('success', 'Wisata berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting destination attraction: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }

    public function destinationFacilityCreate(Destination $destination)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat fasilitas.');
        }
        return view('dashboard.destinations.facilities.create', compact('destination'));
    }

    public function destinationFacilityStore(Request $request, Destination $destination)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat fasilitas.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'capacity' => 'nullable|integer',
        ]);

        try {
            $destination->facilities()->create($validatedData);

            return redirect()->route('destinations.show', $destination)
                ->with('success', 'Fasilitas berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error creating destination facility: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destinationFacilityEdit(Destination $destination, Facility $facility)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit fasilitas.');
        }

        return view('dashboard.destinations.facilities.edit', compact(
            'destination',
            'facility'
        ));
    }

    public function destinationFacilityUpdate(Request $request, Destination $destination,  Facility $facility)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit fasilitas.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'capacity' => 'nullable|integer',
        ]);

        try {
            $facility->update($validatedData);

            return redirect()->route('destinations.show', $destination)
                ->with('success', 'Fasilitas berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating destination facility: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destinationFacilityDestroy(Destination $destination, Facility $facility)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus fasilitas.');
        }

        try {
            $facility->delete();
            return redirect()->route('destinations.show', $destination)
                ->with('success', 'Fasilitas berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting destination facility: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }

    public function destinationGalleryStore(Request $request, Destination $destination)
    {
        try {
            DB::beginTransaction();

            /** @var User $user */
            $user = Auth::user();

            // Check permissions
            if (!$user->hasRole('admin')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki izin untuk menambah galeri.'
                ], 403);
            }

            // Validate the request
            $validator = validator($request->all(), [
                'galleries' => 'required|array|max:10',
                'galleries.*' => [
                    'required',
                    'image',
                    'mimes:jpeg,png,jpg,gif',
                    'max:2048',
                ]
            ], [
                'galleries.max' => 'Maksimal 10 foto yang dapat diunggah sekaligus.',
                'galleries.*.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $destination = $user->destination;
            $galleries = [];
            $uploadedFiles = [];

            foreach ($request->file('galleries') as $image) {
                try {
                    // Generate unique filename
                    $extension = $image->getClientOriginalExtension();
                    $filename = Str::uuid() . '.' . $extension;

                    // Store image
                    $path = $image->storeAs(
                        'images/destinations/galleries/' . $destination->id,
                        $filename,
                        'public'
                    );

                    $uploadedFiles[] = $path;

                    // Create gallery record
                    $gallery = $destination->galleries()->create([
                        'path' => $path,
                        'galleryable_type' => get_class($destination),
                        'galleryable_id' => $destination->id,
                    ]);

                    $galleries[] = [
                        'id' => $gallery->id,
                        'url' => asset('storage/' . $path)
                    ];
                } catch (\Exception $e) {
                    throw new \Exception('Failed to process image: ' . $e->getMessage());
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil ditambahkan ke galeri',
                'galleries' => $galleries
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            foreach ($uploadedFiles ?? [] as $path) {
                Storage::disk('public')->delete($path);
            }

            Log::error('Gallery upload failed: ' . $e->getMessage(), [
                'user_id' => $user->id ?? null,
                'destination_id' => $destination->id ?? null,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengunggah foto. Silakan coba lagi.'
            ], 500);
        }
    }

    public function destinationGalleryDestroy(Gallery $gallery)
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user->can('delete-galleries') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus galeri.');
        }
        if (
            $gallery->galleryable_type !== get_class($user->destination) ||
            $gallery->galleryable_id !== $user->destination->id
        ) {
            abort(403, 'Anda tidak memiliki akses ke galeri ini.');
        }

        try {
            Storage::disk('public')->delete('images/destinations/galleries' . $gallery->path);
            $gallery->delete();
            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus foto'
            ], 500);
        }
    }
}
