<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodawanie użytkownika</title>
</head>
<body>
    <h3>Dodawanie użytkownika</h3>
    <form action="{{ route('user.add') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Imię" aria-label="Imię" value="{{ old('name') }}" required maxlength="255"><br><br>
        <input type="text" name="surname" placeholder="Nazwisko" aria-label="Nazwisko" value="{{ old('surname') }}" required maxlength="255"><br><br>
        <input type="date" name="birthday" aria-label="Data urodzenia" value="{{ old('birthday') }}" required max="{{ now()->toDateString() }}"><br><br>
        <input type="submit" value="Dodaj użytkownika">
    </form>
    @if ($errors->any())
        <ul role="alert">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <p><a href="{{ route('user.records') }}">Użytkownicy w bazie</a></p>
    <p><a href="{{ url('/') }}">Strona główna</a></p>
</body>
</html>
