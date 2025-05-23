<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        // Determine custom view based on user_type
        $customView = match ($user->user_type) {
            'company' => 'user.profile.edit_company',
            'institution' => 'user.profile.edit_institution',
            default => 'user.profile.edit_individual',
        };

        // Use custom view if it exists, fallback to default
        if (view()->exists($customView)) {
            return view($customView, [
                'user' => $user,
                'showOverlay' => session('show_overlay', false),
            ]);
        }

        // Default Breeze-compatible fallback
        return view('profile.edit', [
            'user' => $user,
            'showOverlay' => session('show_overlay', false),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->profile_completed = true;
        $user->save();

        // Redirect to dashboard (custom) or profile edit (Breeze fallback)
        if ($user->role_id === 2) { // example: role_id 2 = staff standard
            return redirect()->route('staff.dashboard')->with('status', 'profile-updated');

        } else  if ($user->role_id === 1) { // example: role_id 1 = addmin standard 
            return redirect()->route('admin.dashboard')->with('status', 'profile-updated');
        }

        return Redirect::route('user.dashboard')->with('status', 'profile-updated');
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
