@extends('adminlte::master')
@section('title', 'Panel WSB — AdminLTE 3')
@section('classes_body', 'hold-transition sidebar-mini')
@section('body')
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" aria-label="Nawigacja panelu">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#" role="button" aria-label="Zwiń lub rozwiń menu"><i class="fas fa-bars" aria-hidden="true"></i></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Strona główna</a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <button class="nav-link btn btn-link" id="logout-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Menu wylogowania" title="Wylogowanie">
                    <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="logout-menu">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt mr-2" aria-hidden="true"></i>Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('home') }}" class="brand-link bg-white text-center" aria-label="Panel WSB">
            <img src="{{ asset('images/wsb-merito.svg') }}" alt="Uniwersytety WSB Merito" style="max-width: 200px; max-height: 80px">
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3"><div class="info text-white">{{ auth()->user()->name }}</div></div>
            <nav aria-label="Menu boczne">
                <ul class="nav nav-pills nav-sidebar flex-column">
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"><i class="nav-icon fas fa-tachometer-alt" aria-hidden="true"></i><p>Panel</p></a></li>
                    <li class="nav-item"><a href="{{ route('panel.form') }}" class="nav-link {{ request()->routeIs('panel.form*') ? 'active' : '' }}"><i class="nav-icon fas fa-edit" aria-hidden="true"></i><p>Formularz</p></a></li>
                </ul>
            </nav>
        </div>
    </aside>
    <main class="content-wrapper">
        <div class="content-header"><div class="container-fluid"><h1 class="m-0">@yield('heading')</h1></div></div>
        <section class="content"><div class="container-fluid"><div class="card"><div class="card-body">@yield('content')</div></div></div></section>
    </main>
    <footer class="main-footer">WSB · Programowanie w zastosowaniach · AdminLTE 3</footer>
</div>
@endsection
