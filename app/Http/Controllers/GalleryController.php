<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        /** @var \User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk melihat galeri.');
        }

        $galleries = Gallery::paginate(5);
        return view('dashboard.galleries.index', compact('galleries'));
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
            abort(403, 'Anda tidak memiliki izin untuk melihat galeri.');
        }

        return view('dashboard.galleries.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGalleryRequest $request)
    {
        //

        $validatedData = $request->validated();
        try {
            $imageName = null;
            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $extension = $image->getClientOriginalExtension();
                $slug = Str::slug($validatedData['name'], '-');
                $imageName = "{$slug}.{$extension}";
                $image->storeAs('images/galleries', $imageName, 'public');
            }

            Gallery::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'image' => $imageName
            ]);

            return redirect()->route('galleries.index')->with('success', 'Galeri berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat galeri.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
        /** @var \User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk melihat galeri.');
        }

        return view('dashboard.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        //

        $validatedData = $request->validated();

        try {
            $imageName = $gallery->image;
            if ($request->hasFile('thumbnail')) {
                if ($imageName) {
                    Storage::disk('public')->delete("images/galleries/" . $imageName);
                }
                $image = $request->file('thumbnail');
                $extension = $image->getClientOriginalExtension();
                $slug = Str::slug($validatedData['name'], '-');
                $imageName = "{$slug}.{$extension}";
                $image->storeAs('images/galleries', $imageName, 'public');
            }

            $gallery->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'image' => $imageName
            ]);

            return redirect()->route('galleries.index')->with('success', 'Galeri berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui galeri.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        //
        try {
            if ($gallery->image) {
                Storage::disk('public')->delete("images/galleries/" . $gallery->image);
            }

            $gallery->delete();

            return redirect()->route('galleries.index')->with('success', 'Galeri berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus galeri.');
        }
    }
}
