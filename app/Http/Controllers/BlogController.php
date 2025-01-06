<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('super-admin')) {
            $blogs = Blog::paginate(10);
        } elseif ($user->can('view-blogs')) {
            $blogs = Blog::where('user_id', Auth::id())->paginate(10);
        } else {
            abort(403, 'Anda tidak memiliki izin untuk melihat blog.');
        }

        return view('dashboard.blogs.index', compact('blogs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasPermissionTo('create-blogs')) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk membuat blog.');
        }
        $tags = Tag::pluck('name');
        return view('dashboard.blogs.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        //
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasPermissionTo('create-blogs')) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk membuat blog.');
        }
        $validatedData = $request->validated();

        try {
            $tags = json_decode($request->tags, true);
            $slug = Str::slug($validatedData['title'], '-');

            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $extension = $image->getClientOriginalExtension();
                $imageName = "{$slug}.{$extension}";
                $path = $image->storeAs('images/blogs', $imageName, 'public');
                $validatedData['thumbnail'] = $path;
            }
            $blog = Blog::create([
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'excerpt' => $validatedData['excerpt'],
                'status' => $validatedData['status'],
                'thumbnail' => $validatedData['thumbnail'],
                'slug' => $slug,
                'user_id' => Auth::id(),
            ]);
            if ($request->has('tags')) {
                $tagIds = collect($tags)->map(function ($tag) {
                    return Tag::firstOrCreate(['name' => $tag['value']])->id;
                });
                $blog->tags()->sync($tagIds);
            }

            return redirect()->route('blogs.index')->with('success', 'Blog berhasil disimpan.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan blog.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasPermissionTo('view-blogs') && $blog->user_id !== Auth::id() && !$user->hasRole('super-admin')) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk melihat blog ini.');
        }
        return view('dashboard.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasPermissionTo('edit-blogs') && $blog->user_id !== Auth::id() && !$user->hasRole('super-admin')) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit blog ini.');
        }

        $tags = $blog->tags->pluck('name')->toArray();
        $allTags = Tag::pluck('name')->toArray();

        return view('dashboard.blogs.edit', compact('blog', 'tags', 'allTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasPermissionTo('edit-blogs') && $blog->user_id !== Auth::id() && !$user->hasRole('super-admin')) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah blog ini.');
        }

        $validatedData = $request->validated();

        try {
            $tags = json_decode($request->tags, true);
            $slug = Str::slug($validatedData['title'], '-');
            $imageName = $blog->thumbnail;

            if ($request->hasFile('thumbnail')) {
                if ($blog->thumbnail) {
                    Storage::disk('public')->delete($blog->image);
                }

                $image = $request->file('thumbnail');
                $extension = $image->getClientOriginalExtension();
                $imageName = "{$slug}.{$extension}";
                $path = $image->storeAs('images/blogs', $imageName, 'public');
                $imageName = $path;
            }

            $blog->update([
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'excerpt' => $validatedData['excerpt'],
                'status' => $validatedData['status'],
                'image' => $imageName,
                'slug' => $slug,
            ]);

            if ($request->has('tags')) {
                $tagIds = collect($tags)->map(function ($tag) {
                    return Tag::firstOrCreate(['name' => $tag['value']])->id;
                });
                $blog->tags()->sync($tagIds);
            }

            return redirect()->route('blogs.index')
                ->with('success', 'Blog berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui blog.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
