<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModelTestController extends Controller
{
    public function form(): View
    {
        return view('test.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'birthday' => ['required', 'date_format:Y-m-d', 'before_or_equal:today'],
            'height' => ['required', 'numeric', 'gt:0', 'max:300', 'decimal:0,2'],
        ], [
            'name.required' => 'Podaj imię.',
            'surname.required' => 'Podaj nazwisko.',
            'email.required' => 'Podaj e-mail.',
            'email.email' => 'Podaj poprawny e-mail.',
            'birthday.required' => 'Podaj datę urodzenia.',
            'birthday.date_format' => 'Podaj poprawną datę urodzenia.',
            'birthday.before_or_equal' => 'Data urodzenia nie może być w przyszłości.',
            'height.required' => 'Podaj wzrost.',
            'height.numeric' => 'Wzrost musi być liczbą.',
            'height.gt' => 'Wzrost musi być większy od zera.',
            'height.max' => 'Wzrost może wynosić maksymalnie 300 cm.',
            'height.decimal' => 'Podaj wzrost z najwyżej dwiema cyframi po przecinku.',
        ]);

        Test::create($data);

        return redirect()->route('topic9.tests.list')->with('status', 'Użytkownik został dodany do tabeli tests.');
    }

    public function index(): View
    {
        $users = Test::orderBy('id')->get();

        return view('test.list', compact('users'));
    }
}
