<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprawdzenie książki</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main class="container">
        <h1>Sprawdzenie książki</h1>
        @if ($book)
            <p class="form-error" role="alert">Błąd: książka „{{ $book->title }}” już istnieje w tabeli books.</p>
            <p><a href="{{ route('books') }}#book-{{ $book->id }}">Zobacz książkę „{{ $book->title }}”</a></p>
        @endif
        <nav aria-label="Nawigacja"><a href="{{ url('/') }}">Strona główna</a></nav>
    </main>
</body>
</html>
