<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public function index()
    {

        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            return view('dashboard.profile.index');
        } else {
            abort(403, 'Anda tidak memiliki izin untuk melihat profil.');
        }
    }

    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {

        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            return view('dashboard.profile.edit');
        } else {
            abort(403, 'Anda tidak memiliki izin untuk menyunting profil.');
        }
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $validatedData = $request->validated();
        $slug = $this->generateUniqueSlug($validatedData['name']);
        $imageName = $user->avatar;

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $image = $request->file('avatar');
            $extension = $image->getClientOriginalExtension();
            $imageName = "{$slug}.{$extension}";
            $path = $image->storeAs('images/users', $imageName, 'public');
            $user->avatar = $path;
        }

        $user->update([
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'avatar' => $imageName,
        ]);

        return Redirect::route('profile.index')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    private function generateUniqueSlug($name)
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
}
