<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body class="course-home">
@php
    $topics = [
        ['number' => '03', 'title' => 'Routing, widoki i kontrolery', 'description' => 'Od adresu strony do odpowiedzi aplikacji.', 'wide' => true, 'links' => [
            ['url' => url('/witaj'), 'title' => 'Powitanie', 'description' => 'Ćw. 2 · Odpowiedź z funkcji obsługującej trasę.'],
            ['url' => url('/test'), 'title' => 'Test kontrolera', 'description' => 'Ćw. 2 · Odpowiedź z TestController.'],
            ['url' => url('/users/42'), 'title' => 'Użytkownik 42', 'description' => 'Ćw. 3 · Identyfikator przekazany w adresie.'],
            ['url' => url('/photo/Krakow/Dluga'), 'title' => 'Zdjęcie z miasta', 'description' => 'Ćw. 3 · Miasto i ulica z parametrów trasy.'],
            ['url' => url('/photo'), 'title' => 'Zdjęcie bez miasta', 'description' => 'Ćw. 3 · Parametry opcjonalne i ulica main.'],
            ['url' => url('/12/32/321'), 'title' => 'Pojemność bryły', 'description' => 'Ćw. 4 · Wynik 123264 m³ na żółtej stronie.'],
        ]],
        ['number' => '05', 'title' => 'Wykorzystanie formularzy', 'description' => 'Wysyłanie danych i zabezpieczenie CSRF.', 'links' => [
            ['url' => route('userform'), 'title' => 'Formularz użytkownika', 'description' => 'Ćw. 5 · Wypełnij pola i pokaż wynik wysłania.'],
        ]],
        ['number' => '06', 'title' => 'Walidacja danych', 'description' => 'Sprawdzanie poprawności pól formularza.', 'links' => [
            ['url' => route('userform'), 'title' => 'Walidacja formularza', 'description' => 'Ćw. 6 · Ten sam formularz; sprawdź błędne dane i hasło.'],
        ]],
        ['number' => '07', 'title' => 'Baza danych i migracje', 'description' => 'Zapisywanie rekordów, Faker i odczyt z MariaDB.', 'wide' => true, 'links' => [
            ['url' => route('adduser'), 'title' => 'Dodawanie użytkownika', 'description' => 'Ćw. 7A · Formularz zapisujący dane do bazy.'],
            ['url' => route('user.records'), 'title' => 'Zapisani użytkownicy', 'description' => 'Ćw. 7A · Rekordy z tabeli user.'],
            ['url' => route('books'), 'title' => 'Książki z Fakera', 'description' => 'Ćw. 7B · Tabela tytułów i autorów.'],
            ['url' => route('books.check'), 'title' => 'Sprawdzenie książki', 'description' => 'Ćw. 7B · Komunikat i link do istniejącej książki.'],
        ]],
        ['number' => '08', 'title' => 'Autoryzacja', 'description' => 'Konta użytkowników i chroniony panel AdminLTE.', 'wide' => true, 'links' => [
            ['url' => route('register'), 'title' => 'Rejestracja', 'description' => 'Utwórz nowe konto w tabeli users.'],
            ['url' => route('login'), 'title' => 'Logowanie', 'description' => 'Zaloguj się na utworzone konto.'],
            ['url' => route('home'), 'title' => 'Panel użytkownika', 'description' => 'Panel po zalogowaniu oraz menu Logout.'],
            ['url' => route('panel.form'), 'title' => 'Formularz w panelu', 'description' => 'Imię, nazwisko i wynik wysłania POST.'],
        ]],
        ['number' => '09', 'title' => 'Modele', 'description' => 'Osobne ćwiczenia z odczytem i zapisem przez Eloquent.', 'wide' => true, 'links' => [
            ['url' => route('topic9.books'), 'title' => 'Lista książek', 'description' => 'Ćw. 9A · e24 · Trzy książki pobrane przez model Book.'],
            ['url' => route('topic9.tests.form'), 'title' => 'Formularz z modelem', 'description' => 'Ćw. 9B · e24_v1 · Dodaj osobę do tabeli tests.'],
            ['url' => route('topic9.tests.list'), 'title' => 'Użytkownicy z tabeli tests', 'description' => 'Ćw. 9B · e24_v1 · Pokaż wszystkie zapisane dane.'],
        ]],
    ];
@endphp
<a class="home-skip" href="#tematy">Przejdź do tematów</a>
<main class="course-shell">
    <header class="course-header">
        <div class="course-brand">
            <img src="{{ asset('images/wsb-merito.svg') }}" alt="Uniwersytety WSB Merito" width="190" height="40">
            <span class="course-version">Laravel 12</span>
        </div>
        <p class="course-eyebrow">Programowanie w zastosowaniach</p>
        <h1>Witaj na mojej stronie!</h1>
        <p class="course-intro">Wybierz temat i otwórz ćwiczenie, które chcesz pokazać.</p>
        <nav class="topic-shortcuts" aria-label="Przejdź do tematu">
            @foreach ($topics as $topic)
                <a href="#temat-{{ (int) $topic['number'] }}">Temat {{ (int) $topic['number'] }}</a>
            @endforeach
        </nav>
    </header>
    <div class="topic-grid" id="tematy">
        @foreach ($topics as $topic)
        <section class="topic-card {{ ($topic['wide'] ?? false) ? 'topic-card-wide' : '' }}" id="temat-{{ (int) $topic['number'] }}" aria-labelledby="heading-{{ $topic['number'] }}">
            <header class="topic-heading">
                <span class="topic-number" aria-hidden="true">{{ $topic['number'] }}</span>
                <div>
                    <h2 id="heading-{{ $topic['number'] }}">Temat {{ (int) $topic['number'] }} — {{ $topic['title'] }}</h2>
                    <p>{{ $topic['description'] }}</p>
                </div>
            </header>
            <nav class="exercise-links" style="--link-columns: {{ count($topic['links']) === 4 ? 2 : 3 }}" aria-label="Ćwiczenia tematu {{ (int) $topic['number'] }}">
                @foreach ($topic['links'] as $link)
                <a class="exercise-link" href="{{ $link['url'] }}">
                    <span><strong>{{ $link['title'] }}</strong><span class="exercise-description">{{ $link['description'] }}</span></span>
                    <span class="exercise-arrow" aria-hidden="true">↗</span>
                </a>
                @endforeach
            </nav>
        </section>
        @endforeach
    </div>
    <footer class="course-footer">Ćwiczenia z zajęć · Każdy temat w jednym miejscu.</footer>
</main>
</body>
</html>
