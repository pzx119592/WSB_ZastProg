<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dane użytkownika</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="user-form-page">
    <main class="form-container">
        <h1>Dane użytkownika</h1>
        <form class="user-form" action="{{ route('form.submit') }}" method="POST">
            @csrf
            <div>
                <label class="visually-hidden" for="name">Imię</label>
                <input id="name" name="name" type="text" placeholder="Podaj swoje imię"
                       value="{{ old('name') }}" required minlength="2" maxlength="100" autocomplete="given-name">
                @error('name')
                    <p class="form-error" role="alert">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="visually-hidden" for="email">Adres e-mail</label>
                <input id="email" name="email" type="email" placeholder="Podaj swój adres @"
                       value="{{ old('email') }}" required maxlength="254" autocomplete="email">
                @error('email')
                    <p class="form-error" role="alert">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="visually-hidden" for="password">Hasło</label>
                <input id="password" name="password" type="password" placeholder="Podaj hasło"
                       required minlength="5" maxlength="100" autocomplete="new-password">
                @error('password')
                    <p class="form-error" role="alert">{{ $message }}</p>
                @enderror
            </div>
            <fieldset class="gender-options">
                <legend class="visually-hidden">Płeć</legend>
                <label><input name="gender" type="radio" value="male" @checked(old('gender', 'male') === 'male') required> Mężczyzna</label>
                <label><input name="gender" type="radio" value="female" @checked(old('gender', 'male') === 'female')> Kobieta</label>
                @error('gender')
                    <p class="form-error" role="alert">{{ $message }}</p>
                @enderror
            </fieldset>
            <button type="submit">Zatwierdź</button>
        </form>
        <nav aria-label="Nawigacja"><a href="{{ url('/') }}">Strona główna</a></nav>
    </main>
</body>
</html>
