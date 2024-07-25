<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Profile;
use App\Models\Movie;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function createProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if (auth()->user()->profiles()->count() >= 4) {
            return back()->withErrors(['message' => 'You can have up to 4 profiles.']);
        }

        auth()->user()->profiles()->create(['name' => $request->name]);

        return redirect()->route('profiles.index');
    }

    public function markAsWatched(Profile $profile, Movie $movie)
    {
        $profile->movies()->updateExistingPivot($movie->id, ['watched' => true]);

        return back()->with('success', 'Movie marked as watched!');
    }

    public function markAsUnwatched(Profile $profile, Movie $movie)
    {
        $profile->movies()->updateExistingPivot($movie->id, ['watched' => false]);

        return back()->with('success', 'Movie marked as unwatched!');
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
}
