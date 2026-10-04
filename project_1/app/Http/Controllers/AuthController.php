<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function loginForm(): View
    {
        return view('auth.login');
    }

    public function registerForm(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:72', 'confirmed'],
        ], [
            'name.required' => 'Podaj imię i nazwisko.',
            'name.min' => 'Nazwa musi mieć co najmniej 3 znaki.',
            'email.required' => 'Podaj adres e-mail.',
            'email.email' => 'Podaj poprawny adres e-mail.',
            'email.unique' => 'Konto z tym adresem e-mail już istnieje.',
            'password.required' => 'Podaj hasło.',
            'password.min' => 'Hasło musi mieć co najmniej 8 znaków.',
            'password.max' => 'Hasło może mieć maksymalnie 72 znaki.',
            'password.confirmed' => 'Potwierdzenie hasła musi być takie samo.',
        ]);

        // Model User ma cast password => hashed: baza nie przechowuje jawnego hasła.
        User::create($data);

        return redirect()->route('login')->with('status', 'Konto zostało utworzone. Zaloguj się.');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Podaj adres e-mail.',
            'email.email' => 'Podaj poprawny adres e-mail.',
            'password.required' => 'Podaj hasło.',
        ]);

        if (! Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Nieprawidłowy e-mail lub hasło.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Zostałeś wylogowany.');
    }
}
