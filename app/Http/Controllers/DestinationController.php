<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinationRequest;
use App\Http\Requests\UpdateDestinationRequest;
use App\Models\Attraction;
use App\Models\DestinationPriceRule;
use App\Models\Facility;
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
        if ($user->hasRole('super-admin')) {
            $destinations = Destination::paginate(10);
            return view('dashboard.destinations.index', compact('destinations'));
        } elseif ($user->can('view-destinations')) {
            $destination = $user->destination;
            return view('dashboard.destinations.show', compact('destination'));
        } else {
            abort(403, 'Anda tidak memiliki izin untuk melihat destinasi.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('create-destinations') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat destinasi.');
        }
        return view('dashboard.destinations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDestinationRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('create-destinations') && !$user->hasRole('super-admin')) {
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

            $user->assignRole('destination-owner');

            $destinationSlug = $this->generateUniqueSlugDestination($validatedData['destination_name']);

            Destination::create([
                'user_id' => $user->id,
                'name' => $validatedData['destination_name'],
                'description' => $validatedData['destination_description'],
                'slug' => $destinationSlug,
                'status' => 'draft',
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
        if (!$user->hasRole('super-admin')) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk melihat destinasi ini.');
        }
        $destination->load('galleries', 'comments', 'ratings');
        return view('dashboard.destinations.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('edit-destinations')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit destinasi.');
        }
        $destination = Auth::user()->destination;
        return view('dashboard.destinations.edit', compact(
            'destination',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDestinationRequest $request)
    {
        //
        $validatedData = $request->validated();
        try {
            $destination = Auth::user()->destination;
            $imageName = $destination->thumbnail;
            $slug = $this->generateUniqueSlugDestination($validatedData['name']);
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
                'capacity' => $validatedData['capacity'],
                'address' => $validatedData['address'],
                'open_at' => $validatedData['open_at'],
                'close_at' => $validatedData['close_at'],
                'thumbnail' => $imageName,
            ]);
            return redirect()->route('destinations.index')
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
    }

    private function generateUniqueSlugDestination($name)
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

    public function destinationPriceCreate()
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('create-prices') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat destinasi.');
        }
        $priceRuleTypes = PriceRuleType::all();
        return view('dashboard.destinations.prices.create', compact('priceRuleTypes'));
    }

    public function destinationPriceStore(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('create-prices') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat destinasi.');
        }

        $request->validate([
            'price_rule_type_id' => 'required|exists:price_rule_types,id',
            'price' => 'required|numeric',
        ]);

        try {
            DestinationPriceRule::create([
                'destination_id' => $user->destination->id,
                'price_rule_type_id' => $request->price_rule_type_id,
                'price' => $request->price,
                'status' => 'active',
            ]);

            return redirect()->route('destinations.index')
                ->with('success', 'Harga berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error creating destination price: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destinationPriceEdit(DestinationPriceRule $destinationPriceRule)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('edit-prices') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit harga.');
        }
        $priceRuleTypes = PriceRuleType::all();
        return view('dashboard.destinations.prices.edit', compact('destinationPriceRule', 'priceRuleTypes'));
    }

    public function destinationPriceUpdate(Request $request, DestinationPriceRule $destinationPriceRule)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('edit-prices') && !$user->hasRole('super-admin')) {
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

            return redirect()->route('destinations.index')
                ->with('success', 'Harga berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating destination price: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destinationPriceDestroy(DestinationPriceRule $destinationPriceRule)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('delete-prices') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus harga.');
        }

        try {
            $destinationPriceRule->delete();
            return redirect()->route('destinations.index')
                ->with('success', 'Harga berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting destination price: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }

    public function destinationAttractionCreate()
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('create-attractions') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat destinasi.');
        }
        return view('dashboard.destinations.attractions.create');
    }

    public function destinationAttractionStore(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('create-attractions') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat destinasi.');
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
            $user->destination->attractions()->create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'thumbnail' => $imageName,
            ]);

            return redirect()->route('destinations.index')
                ->with('success', 'Wisata berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error creating destination attraction: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destinationAttractionEdit(Attraction $attraction)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('edit-attractions') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit wisata.');
        }

        return view('dashboard.destinations.attractions.edit', compact('attraction'));
    }

    public function destinationAttractionUpdate(Request $request, Attraction $attraction)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('edit-attractions') && !$user->hasRole('super-admin')) {
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

            return redirect()->route('destinations.index')
                ->with('success', 'Wisata berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating destination attraction: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destinationAttractionDestroy(Attraction $attraction)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('delete-attractions') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus wisata.');
        }

        try {
            if ($attraction->thumbnail) {
                Storage::disk('public')->delete('images/destinations/attractions/' . $attraction->thumbnail);
            }
            $attraction->delete();
            return redirect()->route('destinations.index')
                ->with('success', 'Wisata berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting destination attraction: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }

    public function destinationFacilityCreate()
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('create-facilities') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat destinasi.');
        }
        return view('dashboard.destinations.facilities.create');
    }

    public function destinationFacilityStore(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('create-facilities') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk membuat destinasi.');
        }

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'capacity' => 'nullable|integer',
        ]);

        try {
            $user->destination->facilities()->create($request->only('name', 'description', 'capacity'));

            return redirect()->route('destinations.index')
                ->with('success', 'Fasilitas berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error creating destination facility: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destinationFacilityEdit(Facility $facility)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('edit-facilities') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit fasilitas.');
        }

        return view('dashboard.destinations.facilities.edit', compact('facility'));
    }

    public function destinationFacilityUpdate(Request $request, Facility $facility)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('edit-facilities') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit fasilitas.');
        }

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'capacity' => 'nullable|integer',
        ]);

        try {
            $facility->update($request->only('name', 'description', 'capacity'));

            return redirect()->route('destinations.index')
                ->with('success', 'Fasilitas berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating destination facility: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destinationFacilityDestroy(Facility $facility)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('delete-facilities') && !$user->hasRole('super-admin')) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus fasilitas.');
        }

        try {
            $facility->delete();
            return redirect()->route('destinations.index')
                ->with('success', 'Fasilitas berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting destination facility: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }
}
