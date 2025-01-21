<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $events = Event::paginate(10);
        } else {
            abort(403, 'Anda tidak memiliki izin untuk melihat event.');
        }

        return view('dashboard.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk membuat event.');
        }
        return view('dashboard.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();
            $slug = $this->generateUniqueSlug($validatedData['title']);

            $imageName = null;
            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $extension = $image->getClientOriginalExtension();
                $imageName = "{$slug}.{$extension}";
                $image->storeAs('images/events', $imageName, 'public');
            }

            Event::create([
                'user_id' => Auth::id(),
                'title' => $validatedData['title'],
                'slug' => $slug,
                'location' => $validatedData['location'],
                'price' => $validatedData['price'] ?? 0,
                'registration_url' => $validatedData['registration_url'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
                'start_at' => $validatedData['start_at'],
                'end_at' => $validatedData['end_at'],
                'description' => $validatedData['description'],
                'image' => $imageName,
                'status' => 'published',
            ]);

            DB::commit();

            return redirect()->route('events.index')
                ->with('success', 'Event berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Event Creation Error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan event.')
                ->withInput();
        }
    }


    public function show(Event $event)
    {
        //
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk melihat event ini.');
        }
        return view('dashboard.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        //
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit event ini.');
        }
        return view('dashboard.events.edit', compact(
            'event',
        ));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        //
        $validatedData = $request->validated();
        try {
            $slug = $this->generateUniqueSlug($validatedData['title']);

            $imageName = $event->image;

            if ($request->hasFile('thumbnail')) {
                if ($event->thumbnail) {
                    Storage::disk('public')->delete('images/events/' . $event->thumbnail);
                }

                $image = $request->file('thumbnail');
                $extension = $image->getClientOriginalExtension();
                $imageName = "{$slug}.{$extension}";
                $image->storeAs('images/events', $imageName, 'public');
            }

            $event->update([
                'title' => $validatedData['title'],
                'slug' => $slug,
                'location' => $validatedData['location'],
                'price' => $validatedData['price'] ?? 0,
                'registration_url' => $validatedData['registration_url'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
                'start_at' => $validatedData['start_at'],
                'end_at' => $validatedData['end_at'],
                'description' => $validatedData['description'],
                'thumbnail' => $imageName,
            ]);

            return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui event.');
        }
    }

    public function destroy(Event $event)
    {
        //
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus event ini.');
        }
        try {
            if ($event->thumbnail) {
                Storage::disk('public')->delete('images/events/' . $event->thumbnail);
            }
            $event->delete();
            return redirect()->route('events.index')
                ->with('success', 'Event berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus event.');
        }
    }

    private function generateUniqueSlug($name)
    {
        $baseSlug = Str::slug($name);
        $randomString = Str::random(8);
        $slug = $baseSlug . '-' . $randomString;
        $count = 1;

        while (Event::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $randomString . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
