<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

public function callbackGoogle()
{
    try {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Find existing user
        $user = User::where('google_id', $googleUser->getId())
                    ->orWhere('email', $googleUser->getEmail())
                    ->first();

        if (!$user) {
            // Create new user
            $user = User::create([
                'name'      => $googleUser->getName() ?? $googleUser->getEmail(),
                'email'     => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password'  => bcrypt(Str::random(16)),
            ]);

            // Create channel for user
            $slug = Str::slug($googleUser->getName() ?? $googleUser->getEmail(), '-');
            $slugUnique = $slug . '-' . uniqid();

            $user->channel()->create([
                'name' => $googleUser->getName() ?? 'New User',
                'slug' => $slugUnique,
                'uid'  => uniqid(true),
            ]);
        } else {
            // If user exists but has no google_id, update it
            if (!$user->google_id) {
                $user->update(['google_id' => $googleUser->getId()]);
            }
        }

        Auth::login($user);

        return redirect()->intended(route('dashboard'));

    } catch (\Throwable $th) {
        return redirect()->route('login')->with('error', 'Google login failed, please try again.');
    }
}

}
