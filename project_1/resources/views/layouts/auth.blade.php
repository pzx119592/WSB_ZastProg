@extends('adminlte::master')
@section('title', 'Konto użytkownika — WSB')
@section('classes_body', 'hold-transition login-page')
@section('body')
<main class="login-box my-4">
    <div class="login-logo bg-white rounded p-3">
        <img src="{{ asset('images/wsb-merito.png') }}" alt="Uniwersytet WSB Merito" class="img-fluid" style="max-height: 100px">
        <div class="h5 mt-2 mb-0 text-dark">WSB Merito</div>
    </div>
    <div class="card"><div class="card-body login-card-body">
        <h1 class="h4 text-center mb-4">@yield('heading')</h1>
        @if (session('status'))
            <div class="alert alert-success" role="status">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" role="alert"><ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul></div>
        @endif
        @yield('content')
        <p class="mt-3 mb-0"><a href="{{ url('/') }}">Strona główna projektu</a></p>
    </div></div>
</main>
@endsection
