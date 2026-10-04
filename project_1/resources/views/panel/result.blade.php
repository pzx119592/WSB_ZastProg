@extends('layouts.panel')
@section('heading', 'Wynik formularza')
@section('content')
<p class="lead">Imię i nazwisko: {{ $name }} {{ $surname }}</p>
<a href="{{ route('panel.form') }}" class="btn btn-primary">Wróć do formularza</a>
@endsection
