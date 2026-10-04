<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class User extends Controller
{
    public function records(): View
    {
        $users = DB::table('user')->orderBy('id')->get();
        return view('user_records', compact('users'));
    }

    public function addUser(Request $req): Collection
    {
        $data = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date_format:Y-m-d', 'before_or_equal:today'],
        ], [
            'name.required' => 'Podaj imię.',
            'surname.required' => 'Podaj nazwisko.',
            'birthday.required' => 'Podaj datę urodzenia.',
            'birthday.date_format' => 'Podaj poprawną datę urodzenia.',
            'birthday.before_or_equal' => 'Data urodzenia nie może być w przyszłości.',
        ]);
        DB::table('user')->insert($data);

        // Jak w PDF: kolekcja rekordów jest zwracana jako JSON.
        return DB::table('user')->orderBy('id')->get();
    }
}
