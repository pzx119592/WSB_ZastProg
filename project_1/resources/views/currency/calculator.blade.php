<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator walut</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main class="container">
        <h1>Kalkulator walut</h1>
        <p>Przelicz złote na EUR, CHF lub USD według kursu sprzedaży NBP.</p>
        <form action="{{ route('topic10.convert') }}" method="POST">
            @csrf
            <p>
                <label for="amount">Kwota w złotych</label><br>
                <input id="amount" name="amount" type="text" inputmode="decimal" required
                    value="{{ old('amount', $amount ?? '') }}" placeholder="np. 200,00" aria-describedby="amount-error">
            </p>
            @error('amount') <p id="amount-error" class="form-error" role="alert">{{ $message }}</p> @enderror
            <fieldset>
                <legend>Na jaką walutę chcesz zamienić złote?</legend>
                @foreach ($currencies as $code => $name)
                    <label>
                        <input type="radio" name="currency" value="{{ $code }}" required
                            @checked(old('currency', $currency ?? 'EUR') === $code)>
                        {{ $name }} ({{ $code }})
                    </label>
                @endforeach
            </fieldset>
            @error('currency') <p class="form-error" role="alert">{{ $message }}</p> @enderror
            <p><button type="submit">Przelicz</button></p>
        </form>
        @isset($apiError)
            <p class="form-error" role="alert">{{ $apiError }}</p>
        @endisset
        @isset($result)
            <p><strong>Za kwotę {{ number_format((float) $amount, 2, ',', ' ') }} zł można zakupić {{ $result }} {{ strtolower($currency) }}.</strong></p>
            <p>Kurs sprzedaży: {{ number_format($ask, 4, ',', ' ') }} zł.
                Tabela {{ $table['number'] }}, data publikacji: {{ $table['date'] }}.</p>
            <p>Wynik zaokrąglamy w dół do pełnych jednostek waluty.</p>
        @endisset
        <nav aria-label="Nawigacja">
            <a href="{{ route('topic10.rates') }}">Kursy walut</a>
            <a href="{{ url('/') }}">Strona główna</a>
        </nav>
    </main>
</body>
</html>
