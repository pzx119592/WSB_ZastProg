<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zdjęcie</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main class="container">
        <h1>Informacje o zdjęciu</h1>
        @if (is_null($city))
            <p>To jest zdjęcie bez podanego miasta zrobione na ulicy {{ $street }}.</p>
        @else
            <p>To jest zdjęcie z {{ $city }} zrobione na ulicy {{ $street }}.</p>
        @endif
        <nav aria-label="Nawigacja">
            <a href="{{ url('/') }}">Strona główna</a>
        </nav>
    </main>
</body>
</html>
