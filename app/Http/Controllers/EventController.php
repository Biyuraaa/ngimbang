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
        if ($user->hasRole('super-admin')) {
            $events = Event::paginate(10);
        } elseif ($user->can('view-events')) {
            $events = Event::where('user_id', Auth::id())->paginate(10);
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
        if (!$user->hasPermissionTo('create-events')) {
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
        /** @var User $user */
        $user = Auth::user();
        if (!$user->can('create-events')) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk membuat event.');
        }

        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $thumbnailPath = null;
            if ($request->hasFile('image')) {
                $thumbnail = $request->file('image');
                $thumbnailName = Str::uuid() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnailPath = $thumbnail->storeAs('images/events', $thumbnailName, 'public');
            }
            Event::create([
                'user_id' => $user->id,
                'title' => $validatedData['title'],
                'slug' => $this->generateUniqueSlug($validatedData['title']),
                'location' => $validatedData['location'],
                'price' => $validatedData['price'] ?? 0,
                'registration_url' => $validatedData['registration_url'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
                'start_at' => $validatedData['start_at'],
                'end_at' => $validatedData['end_at'],
                'description' => $validatedData['description'],
                'image' => $thumbnailPath,
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

    public function show(Event $event)
    {
        //
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasPermissionTo('view-events') && $event->user_id !== Auth::id() && !$user->hasRole('super-admin')) {
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
        if (!$user->hasPermissionTo('edit-events') && $event->user_id !== Auth::id() && !$user->hasRole('super-admin')) {
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
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasPermissionTo('edit-events') && $event->user_id !== Auth::id() && !$user->hasRole('super-admin')) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah event ini.');
        }
        $validatedData = $request->validated();

        try {
            $slug = $this->generateUniqueSlug($validatedData['title']);

            $imageName = $event->image;

            if ($request->hasFile('image')) {
                if ($event->image) {
                    Storage::disk('public')->delete($event->image);
                }

                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $imageName = "{$slug}.{$extension}";
                $path = $image->storeAs('images/events', $imageName, 'public');
                $imageName = $path;
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
                'image' => $imageName,
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
    }
}
