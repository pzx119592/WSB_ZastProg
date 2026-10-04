<?php

use App\Http\Controllers\Form;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('strona_glowna');
});

Route::get('/witaj', function () {
    return 'Witaj w aplikacji!';
});

Route::get('/test', [TestController::class, 'index']);

Route::get('/userform', [Form::class, 'index'])->name('userform');
Route::post('/form', [Form::class, 'store'])->name('form.submit');

Route::view('/adduser', 'adduser')->name('adduser');
Route::post('/User', [User::class, 'addUser'])->name('user.add');
Route::get('/user-records', [User::class, 'records'])->name('user.records');
Route::get('/books', [BooksController::class, 'index'])->name('books');
Route::get('/check', [BooksController::class, 'check'])->name('books.check');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:10,1')->name('register.submit');
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1')->name('login.submit');
});
Route::middleware('auth')->group(function () {
    Route::view('/home', 'panel.home')->name('home');
    Route::get('/panel/formularz', [PanelController::class, 'form'])->name('panel.form');
    Route::post('/panel/formularz', [PanelController::class, 'result'])->name('panel.form.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/users/{id}', function (string $id) {
    return 'Identyfikator użytkownika: '.e($id);
});

Route::get('/photo/{city?}/{street?}', function (?string $city = null, string $street = 'main') {
    return view('photo', compact('city', 'street'));
});

// Trasa z trzema wymiarami przyjmuje liczby całkowite i dziesiętne.
Route::get('/{height}/{width}/{depth}', function (string $height, string $width, string $depth) {
    $volume = (float) $height * (float) $width * (float) $depth;

    return view('pojemnosc', compact('height', 'width', 'depth', 'volume'));
})->where([
    'height' => '[0-9]+(?:\.[0-9]+)?',
    'width' => '[0-9]+(?:\.[0-9]+)?',
    'depth' => '[0-9]+(?:\.[0-9]+)?',
]);
