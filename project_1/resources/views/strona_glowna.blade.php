<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="home-page">
    <main class="container">
        <h1>Witaj na mojej stronie!</h1>
        <p>To mój projekt Laravel 12. Poznaję routing, widoki Blade i kontrolery.</p>
        <section>
            <h2>Temat 3 — Routing, Widoki i Kontrolery</h2>
            <nav aria-label="Ćwiczenia tematu 3">
            <a href="{{ url('/witaj') }}">Powitanie</a>
            <a href="{{ url('/test') }}">Test kontrolera</a>
            <a href="{{ url('/users/42') }}">Użytkownik 42</a>
            <a href="{{ url('/photo/Krakow/Dluga') }}">Zdjęcie z miasta</a>
            <a href="{{ url('/photo') }}">Zdjęcie bez miasta</a>
            <a href="{{ url('/12/32/321') }}">Pojemność bryły</a>
            </nav>
        </section>
        <section>
            <h2>Temat 5 — Wykorzystanie formularzy</h2>
            <nav aria-label="Ćwiczenia tematu 5">
            <a href="{{ route('userform') }}">Formularz użytkownika</a>
            </nav>
        </section>
        <section>
            <h2>Temat 6 — Walidacja danych</h2>
            <nav aria-label="Ćwiczenia tematu 6">
                <a href="{{ route('userform') }}">Walidacja formularza użytkownika</a>
            </nav>
        </section>
        <section>
            <h2>Temat 7 — Bazy danych i migracje</h2>
            <nav aria-label="Ćwiczenia tematu 7">
            <a href="{{ route('adduser') }}">Dodawanie użytkownika</a>
            <a href="{{ route('books') }}">Książki</a>
            <a href="{{ route('books.check') }}">Sprawdzenie książki</a>
            </nav>
        </section>
        <section>
            <h2>Temat 8 — Autoryzacja</h2>
            <nav aria-label="Ćwiczenia tematu 8">
            <a href="{{ route('home') }}">Panel użytkownika</a>
            @guest
                <a href="{{ route('register') }}">Rejestracja</a>
                <a href="{{ route('login') }}">Logowanie</a>
            @endguest
            </nav>
        </section>
        <section>
            <h2>Temat 9 — Modele</h2>
            <nav aria-label="Ćwiczenia tematu 9">
                <a href="{{ route('topic9.books') }}">Lista książek — e24</a>
                <a href="{{ route('topic9.tests.form') }}">Formularz — e24_v1</a>
                <a href="{{ route('topic9.tests.list') }}">Użytkownicy z tabeli tests — e24_v1</a>
            </nav>
        </section>
        <section>
            <h2>Temat 10 — API</h2>
            <nav aria-label="Ćwiczenia tematu 10">
                <a href="{{ route('topic10.rates') }}">Kursy walut NBP</a>
                <a href="{{ route('topic10.calculator') }}">Kalkulator walut</a>
            </nav>
        </section>
    </main>
</body>
</html>
