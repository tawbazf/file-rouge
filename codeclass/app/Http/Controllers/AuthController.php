<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{ public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            // 'role' => 'required|in:user,teacher', // Valider le rôle
            // 'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Valider l'avatar
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // // Gérer l'upload de l'avatar
        // $avatarPath = null;
        // if ($request->hasFile('avatar')) {
        //     $avatarPath = $request->file('avatar')->store('avatars', 'public');
        // }
    
        // Créer l'utilisateur
       $user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'role' => $request->role, // Rôle défini par l'utilisateur
            // 'avatar' => $avatarPath, // Chemin de l'avatar
        ]);
        Auth::login($user);

        // Rediriger vers la page de sélection de rôle
        return redirect()->route('choose.role');
        // return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');
    
        try {
            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred during login.'])->withInput();
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'You have been logged out.');
    }
    public function showForgotPasswordForm()
{
    return view('auth.passwords.email'); // Assurez-vous que cette vue existe
}

public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);

    // Utilisez Password::sendResetLink pour envoyer l'email de réinitialisation
    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
}
}