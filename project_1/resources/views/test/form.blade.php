<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj użytkownika</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="user-form-page">
<main class="form-container">
    <h1>Dodaj użytkownika</h1>
    @if ($errors->any())
        <div class="form-error" role="alert"><ul>
            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul></div>
    @endif
    <form class="user-form" method="POST" action="{{ route('topic9.tests.store') }}">
        @csrf
        <label><span class="visually-hidden">Imię</span><input type="text" name="name" placeholder="Podaj imię" value="{{ old('name') }}" required maxlength="255" autocomplete="given-name"></label>
        <label><span class="visually-hidden">Nazwisko</span><input type="text" name="surname" placeholder="Podaj nazwisko" value="{{ old('surname') }}" required maxlength="255" autocomplete="family-name"></label>
        <label><span class="visually-hidden">E-mail</span><input type="email" name="email" placeholder="Podaj email" value="{{ old('email') }}" required maxlength="255" autocomplete="email"></label>
        <label><input style="width: 190px" type="date" name="birthday" value="{{ old('birthday') }}" max="{{ now()->format('Y-m-d') }}" required autocomplete="bday"> Data urodzenia</label>
        <label><span class="visually-hidden">Wzrost w cm</span><input type="number" name="height" placeholder="Podaj wzrost" value="{{ old('height') }}" required min="0.01" max="300" step="0.01"></label>
        <button type="submit">Dodaj użytkownika</button>
    </form>
    <nav aria-label="Nawigacja"><a href="{{ route('topic9.tests.list') }}">Użytkownicy z tabeli tests</a><a href="{{ url('/') }}">Strona główna</a></nav>
</main>
</body>
</html>
