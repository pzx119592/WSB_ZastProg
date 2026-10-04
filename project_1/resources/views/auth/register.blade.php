@extends('layouts.auth')
@section('heading', 'Rejestracja')
@section('content')
<form method="POST" action="{{ route('register.submit') }}">
    @csrf
    <div class="form-group">
        <label for="name">Imię i nazwisko</label>
        <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}" required minlength="3" maxlength="255" autocomplete="name" autofocus>
    </div>
    <div class="form-group">
        <label for="email">E-mail</label>
        <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" required maxlength="255" autocomplete="email">
    </div>
    <div class="form-group">
        <label for="password">Hasło (8–72 znaki)</label>
        <input id="password" name="password" type="password" class="form-control" required minlength="8" maxlength="72" autocomplete="new-password">
    </div>
    <div class="form-group">
        <label for="password_confirmation">Powtórz hasło</label>
        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required minlength="8" maxlength="72" autocomplete="new-password">
    </div>
    <button type="submit" class="btn btn-primary btn-block">Zarejestruj się</button>
</form>
<p class="mt-3 mb-0"><a href="{{ route('login') }}">Mam już konto — zaloguj się</a></p>
@endsection
