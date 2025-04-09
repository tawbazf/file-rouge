<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;


class SocialAuthController extends Controller
{
    // Google Authentication
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        // Logique pour connecter ou enregistrer l'utilisateur
        return redirect()->route('dashboard'); // Redirigez vers une page après connexion
    }

    // GitHub Authentication
    public function redirectToGithub()
    {
        return Socialite::driver('github')->scopes(['user:email'])->redirect();

    }
    public function handleGithubCallback()
    {
        try {
            $user = Socialite::driver('github')
                ->stateless() // Optional, if you're not using sessions
                ->user();
    
            // Your user logic: find or create the user in your database
            $existingUser = User::where('github_id', $user->getId())->first();
            
            if ($existingUser) {
                // Log in the user or update their info
                Auth::login($existingUser);
            } else {
                // Register the user
                $newUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'github_id' => $user->getId(),
                    // Add any other fields you need
                ]);
    
                Auth::login($newUser);
            }
    
            return redirect()->route('home'); // Redirect wherever needed
        } catch (\Exception $e) {
            // Log error for debugging
            Log::error('GitHub callback error: '.$e->getMessage());
            return redirect()->route('login')->withErrors('Authentication failed. Please try again.');
        }
    }
    
}