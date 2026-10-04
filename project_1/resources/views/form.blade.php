<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dane z formularza</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="user-form-page">
    <main class="form-container">
        <h1>Dane z formularza</h1>
        <dl class="form-result">
            <dt>Imię</dt><dd>{{ $data['name'] ?? 'Nie podano' }}</dd>
            <dt>Adres e-mail</dt><dd>{{ $data['email'] }}</dd>
            <dt>Hasło</dt><dd>{{ str_repeat('•', mb_strlen($data['password'])) }}</dd>
            <dt>Płeć</dt><dd>{{ $data['gender'] === 'male' ? 'Mężczyzna' : 'Kobieta' }}</dd>
        </dl>
        <nav aria-label="Nawigacja">
            <a href="{{ route('userform') }}">Wróć do formularza</a>
            <a href="{{ url('/') }}">Strona główna</a>
        </nav>
    </main>
</body>
</html>
