<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Książki</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main class="container">
        <h1>Książki</h1>
        <table class="books-table">
            <thead><tr><th scope="col">title</th><th scope="col">author</th></tr></thead>
            <tbody>
                @forelse ($books as $book)
                    <tr id="book-{{ $book->id }}"><td>{{ $book->title }}</td><td>{{ $book->author }}</td></tr>
                @empty
                    <tr><td colspan="2">Brak książek w bazie.</td></tr>
                @endforelse
            </tbody>
        </table>
        <nav aria-label="Nawigacja">
            <a href="{{ route('books.check') }}">Sprawdzenie książki</a>
            <a href="{{ url('/') }}">Strona główna</a>
        </nav>
    </main>
</body>
</html>
