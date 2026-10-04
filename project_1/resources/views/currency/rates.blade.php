<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursy walut — NBP</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main class="container">
        <h1>Kursy walut — NBP</h1>
        @if ($apiError)
            <p class="form-error" role="alert">{{ $apiError }}</p>
        @else
            <p>Tabela {{ $table['number'] }}, data publikacji: {{ $table['date'] }}.</p>
            <table class="books-table">
                <caption>Kursy kupna i sprzedaży za 1 jednostkę waluty, w PLN</caption>
                <thead>
                    <tr><th scope="col">Waluta</th><th scope="col">Kod</th><th scope="col">Kupno (skup)</th><th scope="col">Sprzedaż</th></tr>
                </thead>
                <tbody>
                    @foreach ($table['rates'] as $code => $rate)
                        <tr>
                            <td>{{ $rate['name'] }}</td><td>{{ $code }}</td>
                            <td>{{ number_format($rate['bid'], 4, ',', ' ') }} zł</td>
                            <td>{{ number_format($rate['ask'], 4, ',', ' ') }} zł</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <nav aria-label="Nawigacja">
            <a href="{{ route('topic10.calculator') }}">Kalkulator walut</a>
            <a href="{{ url('/') }}">Strona główna</a>
            <a href="https://api.nbp.pl/">Źródło: API NBP</a>
        </nav>
    </main>
</body>
</html>
