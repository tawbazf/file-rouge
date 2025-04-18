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
    public function redirectToGithub()
    {
        try {
            return Socialite::driver('github')->stateless()->redirect();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors('Failed to connect to GitHub');
        }
    }

    public function handleGithubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->stateless()->user();

            $user = User::updateOrCreate(
                ['github_id' => $githubUser->getId()],
                [
                    'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                    'email' => $githubUser->getEmail(),
                    'password' => Hash::make(Str::random(24)),
                    'avatar' => $githubUser->getAvatar(),
                ]
            );

            Auth::login($user, true);

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            \Log::error('GitHub Auth Error: '.$e->getMessage());
            return redirect()->route('login')->withErrors('Failed to authenticate with GitHub');
        }
    }

    // --- GOOGLE ---
    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->stateless()->redirect();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors('Failed to connect to Google');
        }
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::updateOrCreate(
                ['google_id' => $googleUser->getId()],
                [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(24)),
                    'avatar' => $googleUser->getAvatar(),
                ]
            );

            Auth::login($user, true);

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            \Log::error('Google Auth Error: '.$e->getMessage());
            return redirect()->route('login')->withErrors('Failed to authenticate with Google');
        }
    }
}