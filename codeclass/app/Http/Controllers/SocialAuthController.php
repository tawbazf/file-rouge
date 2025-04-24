<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    // --- GITHUB ---
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        $githubUser = Socialite::driver('github')->user();

        // If the user doesn't exist create, else update the existing one
        $newUser = User::updateOrCreate([
            'email' => $githubUser->getEmail(),
        ], [
            'name' => $githubUser->getName() ?? $githubUser->getNickname(),
            'password' => bcrypt(Str::random(16)), // Set a random password
            'email_verified_at' => now(),
            'avatar' => $githubUser->getAvatar(),
        ]);

        Auth::login($newUser);

        return redirect('/choose-role');
    }
}