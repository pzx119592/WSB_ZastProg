@extends('layouts.panel')
@section('heading', 'Panel użytkownika')
@section('content')
<h2 class="h4">Witaj, {{ auth()->user()->name }}!</h2>
<p>Jesteś zalogowany jako {{ auth()->user()->email }}.</p>
<p>Wybierz <strong>Formularz</strong> w lewym menu, aby podać imię i nazwisko.</p>
<a class="btn btn-primary" href="{{ route('panel.form') }}">Otwórz formularz</a>
@endsection
