<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // --- Google ---
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        return $this->handleCallback('google');
    }

    // --- Facebook ---
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        return $this->handleCallback('facebook');
    }

    // --- Apple ---
    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    public function handleAppleCallback()
    {
        return $this->handleCallback('apple');
    }

    // --- Shared Logic ---
    protected function handleCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName(),
                'username' => $socialUser->getNickname() ?? explode('@', $socialUser->getEmail())[0],
                'password' => bcrypt(str()->random(16)),
                'email_verified_at' => now(),
            ]
        );

        Auth::login($user);

                   return redirect()->intended(match ($user->role_id) {
                1 => route('admin.dashboard'),
                2 => route('staff.dashboard'),
                3 => route('user.dashboard'),
                default => '/',
            });
    }
}
