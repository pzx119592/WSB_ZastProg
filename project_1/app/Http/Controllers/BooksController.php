<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BooksController extends Controller
{
    public function index(): View
    {
        $books = DB::table('books')->orderBy('id')->get();
        return view('books', compact('books'));
    }

    public function check(Request $request): View
    {
        $data = $request->validate(['title' => ['sometimes', 'required', 'string', 'max:255']]);
        $title = $data['title'] ?? Cache::get('books.check.title', 'The Catcher in the Rye');
        $book = DB::table('books')->where('title', $title)->first();
        return view('check', compact('book'));
    }
}
