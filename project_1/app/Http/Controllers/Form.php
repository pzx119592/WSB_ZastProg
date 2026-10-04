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
            'name' => ['bail', 'nullable', 'string', 'min:3', 'max:20'],
            'email' => ['bail', 'required', 'string', 'min:3', 'max:20', 'email'],
            'password' => [
                'bail', 'required', 'string', 'min:8', 'max:30',
                'regex:/\A(?=.*\p{Ll})(?=.*\p{Lu})(?=.*\p{N})(?=.*[\p{P}\p{S}]).*\z/u',
            ],
            'gender' => ['required', 'in:male,female'],
        ], [
            'name.string' => 'Imię musi być tekstem.',
            'name.min' => 'Imię musi mieć co najmniej 3 znaki.',
            'name.max' => 'Imię może mieć maksymalnie 20 znaków.',
            'email.required' => 'Podaj adres e-mail.',
            'email.string' => 'Adres e-mail musi być tekstem.',
            'email.min' => 'Adres e-mail musi mieć co najmniej 3 znaki.',
            'email.email' => 'Podaj poprawny adres e-mail.',
            'email.max' => 'Adres e-mail może mieć maksymalnie 20 znaków.',
            'password.required' => 'Podaj hasło.',
            'password.string' => 'Hasło musi być tekstem.',
            'password.min' => 'Hasło musi mieć co najmniej 8 znaków.',
            'password.max' => 'Hasło może mieć maksymalnie 30 znaków.',
            'password.regex' => 'Hasło musi zawierać małą literę, dużą literę, cyfrę i znak specjalny.',
            'gender.required' => 'Wybierz płeć.',
            'gender.in' => 'Wybierz jedną z dostępnych opcji płci.',
        ]);

        return view('form', compact('data'));
    }
}
