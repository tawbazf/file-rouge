<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

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
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        $user = Socialite::driver('github')->user();
        // Logique pour connecter ou enregistrer l'utilisateur
        return redirect()->route('home'); // Redirigez vers une page après connexion
    }
}