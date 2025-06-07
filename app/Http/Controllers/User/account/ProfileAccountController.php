<?php
namespace App\Http\Controllers\User\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProfileAccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('user.profile.account.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();

        $view = match ($user->user_type) {
            'company' => 'user.profile.account.edit_company',
            'institution' => 'user.profile.account.edit_institution',
            default => 'user.profile.account.edit_individual',
        };

        return view($view, compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:100'],
            'website' => ['nullable', 'url'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'referral_source' => ['nullable', 'string', 'max:255'],
            'profile_picture' => ['nullable', 'image', 'max:2048'],
        ];

        // Conditional rules based on user type
        if ($user->user_type === 'company') {
            $rules = array_merge($rules, [
                'organization_type' => ['nullable', 'string', 'max:100'],
                'industry' => ['nullable', 'string', 'max:100'],
                'company_registration_number' => ['nullable', 'string', 'max:100'],
                'tax_id' => ['nullable', 'string', 'max:100'],
                'organization_size' => ['nullable', 'string', 'max:50'],
            ]);
        } elseif ($user->user_type === 'institution') {
            $rules = array_merge($rules, [
                'organization_type' => ['nullable', 'string', 'max:100'],
                'industry' => ['nullable', 'string', 'max:100'],
                'organization_size' => ['nullable', 'string', 'max:50'],
            ]);
        }

        $validated = $request->validate($rules);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $validated['profile_picture'] = $request->file('profile_picture')->store(
                'profile_pictures/' . $user->id,
                'public'
            );
        }

        $user->update($validated);

        return Redirect::route('user.profile.account.index')->with('status', 'Profile updated successfully.');
    }

    public function destroy(Request $request)
    {
        $request->validateWithBag('deleteAccount', [
            'password' => ['required', 'current_password'],
        ]);

        $user = Auth::user();

        // Delete profile picture securely
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Account deleted successfully.');
    }
}
