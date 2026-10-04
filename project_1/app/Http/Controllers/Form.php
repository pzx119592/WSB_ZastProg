<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class Form extends Controller
{
    public function index(): View
    {
        return view('userform');
    }

    public function store(Request $request): View
    {
        // Poprawne dane formularza trafiają do tablicy $data.
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required', 'string', 'min:5', 'max:100'],
            'gender' => ['required', 'in:male,female'],
        ], [
            'name.required' => 'Podaj swoje imię.',
            'name.string' => 'Imię musi być tekstem.',
            'name.min' => 'Imię musi mieć co najmniej 2 znaki.',
            'name.max' => 'Imię może mieć maksymalnie 100 znaków.',
            'email.required' => 'Podaj adres e-mail.',
            'email.email' => 'Podaj poprawny adres e-mail.',
            'email.max' => 'Adres e-mail może mieć maksymalnie 254 znaki.',
            'password.required' => 'Podaj hasło.',
            'password.string' => 'Hasło musi być tekstem.',
            'password.min' => 'Hasło musi mieć co najmniej 5 znaków.',
            'password.max' => 'Hasło może mieć maksymalnie 100 znaków.',
            'gender.required' => 'Wybierz płeć.',
            'gender.in' => 'Wybierz jedną z dostępnych opcji płci.',
        ]);

        return view('form', compact('data'));
    }
}
