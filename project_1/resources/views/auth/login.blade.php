@extends('layouts.auth')
@section('heading', 'Logowanie')
@section('content')
<form method="POST" action="{{ route('login.submit') }}">
    @csrf
    <div class="form-group">
        <label for="email">E-mail</label>
        <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" required autocomplete="username" autofocus>
    </div>
    <div class="form-group">
        <label for="password">Hasło</label>
        <input id="password" name="password" type="password" class="form-control" required autocomplete="current-password">
    </div>
    <button type="submit" class="btn btn-primary btn-block">Zaloguj się</button>
</form>
<p class="mt-3 mb-0"><a href="{{ route('register') }}">Utwórz nowe konto</a></p>
@endsection
