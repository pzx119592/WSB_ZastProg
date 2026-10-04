<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pojemność prostopadłościanu</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="volume-page">
    <main class="container">
        <h1>Pojemność prostopadłościanu</h1>
        <p class="volume-message">Prostopadłościan o wymiarach {{ $height }} × {{ $width }} × {{ $depth }} ma pojemność {{ $volume }} m3.</p>
        <nav aria-label="Nawigacja">
            <a href="{{ url('/') }}">Strona główna</a>
        </nav>
    </main>
</body>
</html>
