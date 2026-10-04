<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista książek</title>
</head>
<body>
    <main>
        <h1>Lista książek</h1>
        <ul>
            @forelse ($books as $book)
                <li id="book-{{ $book->id }}">Tytuł: {{ $book->title }}</li>
            @empty
                <li>Brak książek w bazie.</li>
            @endforelse
        </ul>
        <nav aria-label="Nawigacja">
            <a href="{{ url('/') }}">Strona główna</a>
        </nav>
    </main>
</body>
</html>
