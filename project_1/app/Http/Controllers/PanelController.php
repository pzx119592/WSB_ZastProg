<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PanelController extends Controller
{
    public function form(): View
    {
        return view('panel.form');
    }

    public function result(Request $request): View
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'Podaj imię.',
            'surname.required' => 'Podaj nazwisko.',
        ]);

        return view('panel.result', $data);
    }
}
