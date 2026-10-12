<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login page
    public function showLogin()
    {
        return view('login');
    }

    // Login user 
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()
            ->with('error', 'Username or password is incorrect.')
            ->onlyInput('username');
    }

   public function showRegister()
    {
        return view('register');
    }

public function register(Request $request)
{
    $validated = $request->validate([
        'username' => ['required', 'string', 'max:255', 'unique:users,username'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = User::create([
        'username' => $validated['username'],
        'password' => Hash::make($validated['password']),
    ]);

    auth()->login($user);
    $request->session()->regenerate();

    return redirect()->route('dashboard');
}

    // Dashboard page
    public function dashboard()
    {
        return view('dashboard');
    }

    // Logout page
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}