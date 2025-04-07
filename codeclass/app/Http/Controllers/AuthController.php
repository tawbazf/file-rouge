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
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    try {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'An error occurred while creating the user.'])->withInput();
    }

    return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
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
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
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