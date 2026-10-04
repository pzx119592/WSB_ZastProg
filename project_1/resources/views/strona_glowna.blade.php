<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main class="container">
        <h1>Witaj na mojej stronie!</h1>
        <p>To mój projekt Laravel 12. Poznaję routing, widoki Blade i kontrolery.</p>
        <nav aria-label="Nawigacja główna">
            <a href="{{ url('/witaj') }}">Powitanie</a>
            <a href="{{ url('/test') }}">Test kontrolera</a>
            <a href="{{ url('/users/42') }}">Użytkownik 42</a>
            <a href="{{ url('/photo/Krakow/Dluga') }}">Zdjęcie z miasta</a>
            <a href="{{ url('/photo') }}">Zdjęcie bez miasta</a>
            <a href="{{ url('/12/32/321') }}">Pojemność bryły</a>
            <a href="{{ route('userform') }}">Formularz użytkownika</a>
            <a href="{{ route('adduser') }}">Dodawanie użytkownika</a>
            <a href="{{ route('books') }}">Książki</a>
            <a href="{{ route('books.check') }}">Sprawdzenie książki</a>
        </nav>
    </main>
</body>
</html>
