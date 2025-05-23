<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration form for general users.
     */
    public function create(): View
    {
        return view('auth.register'); // Default register view
    }

    /**
     * Handle general user registration.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'user_type' => ['required', 'in:individual,company,institution'], // Add more types if needed
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create a general user (role_id 3 for general users)
        $user = User::create([
            'name' => $request->name,
            'user_type' => $request->user_type,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 3, // Default to general user
            'account_type' => 'main', // Main account
        ]);

        event(new Registered($user));

        Auth::login($user); // Log the user in

        return redirect(route('login', absolute: false)); // Redirect to login
    }

    /**
     * Handle Admin registration.
     */
    public function storeAdmin(Request $request): RedirectResponse
    {
        return $this->storeWithRole($request, 1, 'main'); // 1 = Admin role
    }

    /**
     * Handle Staff registration.
     */
    public function storeStaff(Request $request): RedirectResponse
    {
        return $this->storeWithRole($request, 2, 'main'); // 2 = Staff role
    }

    /**
     * Show Admin registration form.
     */
    public function showAdminRegisterForm()
    {
        return view('auth.register-admin');
    }

    /**
     * Show Staff registration form.
     */
    public function showStaffRegisterForm()
    {
        return view('auth.register-staff');
    }

    /**
     * Shared logic for registering a user with a specific role.
     * 
     * @param Request $request
     * @param int $roleId The role ID to assign
     * @param string $accountType The account type (main/sub)
     * @return RedirectResponse
     */
    protected function storeWithRole(Request $request, int $roleId, string $accountType): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create the user with specific role and account type
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => 'required|string|max:255|unique:users',
            'password' => Hash::make($request->password),
            'role_id' => $roleId,
            'account_type' => $accountType,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard'); // Adjust if needed
    }
}
