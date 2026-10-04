<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Użytkownicy w bazie</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main class="container">
        <h1>Użytkownicy w bazie</h1>
        <table class="books-table">
            <thead><tr><th>id</th><th>name</th><th>surname</th><th>birthday</th><th>create_user</th></tr></thead>
            <tbody>
                @forelse ($users as $user)
                    <tr><td>{{ $user->id }}</td><td>{{ $user->name }}</td><td>{{ $user->surname }}</td><td>{{ $user->birthday }}</td><td>{{ $user->create_user }}</td></tr>
                @empty
                    <tr><td colspan="5">Brak użytkowników w bazie.</td></tr>
                @endforelse
            </tbody>
        </table>
        <nav aria-label="Nawigacja">
            <a href="{{ route('adduser') }}">Dodaj użytkownika</a>
            <a href="{{ url('/') }}">Strona główna</a>
        </nav>
    </main>
</body>
</html>
