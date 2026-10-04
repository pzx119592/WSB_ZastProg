<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Użytkownicy z tabeli tests</title>
</head>
<body>
<main>
    <h1>Użytkownicy z tabeli tests</h1>
    @if (session('status'))<p role="status">{{ session('status') }}</p>@endif
    @forelse ($users as $user)
        <article>
            <p>Imię i nazwisko: {{ $user->name }} {{ $user->surname }}, email: {{ $user->email }}</p>
            <p><small>ID: {{ $user->id }} · Data urodzenia: {{ $user->birthday->format('Y-m-d') }} · Wzrost: {{ $user->height }} cm · Dodano: {{ $user->created_at }} · Zaktualizowano: {{ $user->updated_at }}</small></p>
        </article>
    @empty
        <p>Brak użytkowników w tabeli tests.</p>
    @endforelse
    <nav aria-label="Nawigacja"><a href="{{ route('topic9.tests.form') }}">Dodaj użytkownika</a> | <a href="{{ url('/') }}">Strona główna</a></nav>
</main>
</body>
</html>
