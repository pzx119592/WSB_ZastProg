<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('strona_glowna');
});

Route::get('/witaj', function () {
    return 'Witaj w aplikacji!';
});

Route::get('/test', [TestController::class, 'index']);

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
