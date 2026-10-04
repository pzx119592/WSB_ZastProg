@extends('layouts.panel')
@section('heading', 'Formularz')
@section('content')
@if ($errors->any())
<div class="alert alert-danger" role="alert"><ul class="mb-0">
    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
</ul></div>
@endif
<form method="POST" action="{{ route('panel.form.submit') }}" style="max-width: 540px">
    @csrf
    <div class="form-group"><label for="name">Imię</label><input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}" maxlength="255" required autocomplete="given-name"></div>
    <div class="form-group"><label for="surname">Nazwisko</label><input id="surname" name="surname" type="text" class="form-control" value="{{ old('surname') }}" maxlength="255" required autocomplete="family-name"></div>
    <button type="submit" class="btn btn-primary">Wyślij</button>
</form>
@endsection
