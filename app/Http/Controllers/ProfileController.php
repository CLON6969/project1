<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyProfileUpdateRequest;
use App\Http\Requests\InstitutionProfileUpdateRequest;
use App\Http\Requests\IndividualProfileUpdateRequest;
use Illuminate\Routing\Redirector;
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
public function update(Request $request): RedirectResponse
{
    $user = $request->user();

    // Determine the FormRequest class based on user_type
    $formRequestClass = match ($user->user_type) {
        'company' => CompanyProfileUpdateRequest::class,
        'institution' => InstitutionProfileUpdateRequest::class,
        default => IndividualProfileUpdateRequest::class,
    };

    // Instantiate the FormRequest
    /** @var \Illuminate\Foundation\Http\FormRequest $formRequest */
    $formRequest = app($formRequestClass);

    // Set container and redirector for the FormRequest
$formRequest->setRedirector(app()->make(Redirector::class));


    // Initialize FormRequest with current request data
    $formRequest->initialize(
        $request->query->all(),
        $request->request->all(),
        $request->attributes->all(),
        $request->cookies->all(),
        $request->files->all(),
        $request->server->all(),
        $request->getContent()
    );

    // Run validation (throws ValidationException on failure)
    $formRequest->validateResolved();

    // Get validated data
    $validatedData = $formRequest->validated();

    // Fill user with validated data
    $user->fill($validatedData);

    // Reset email_verified if email changed
    if ($user->isDirty('email')) {
        $user->email_verified = false; 
    }

    $user->profile_completed = true;
    $user->save();

    // Redirect based on role
    if ($user->role_id === 2) {
        return redirect()->route('staff.dashboard')->with('status', 'profile-updated');
    } elseif ($user->role_id === 1) {
        return redirect()->route('admin.dashboard')->with('status', 'profile-updated');
    }

    return redirect()->route('user.dashboard')->with('status', 'profile-updated');
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
