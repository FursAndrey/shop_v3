<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset("favicon.ico") }}">
		
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/custom.css') }}">
		<!-- all css here -->
        @yield('header_styles')
    </head>
    <body class="m-3">
        <div>
            <a @route_active('skuListPage') href="{{ route('skuListPage') }}">Главная</a>
            <a @route_active('showBasket') href="{{ route('showBasket') }}">Корзина</a>
            @auth
            <a @route_active('category.index') href="{{ route('category.index') }}">Админка</a>
            @endauth
            @guest
                <a href="{{ route('login') }}" @route_active('login')>Войти</a>
            @endguest
            @auth
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" title="Выйти" @route_active('logout')>X</button>
                </form>
            @endauth
            <div class="head-menu">
                <a @route_active('#') href="#">{{ session('currency', 'BYN') }}</a>
                <ul>
                    @foreach ($currencies as $currency)
                        <li><a @route_active('setCurrency') href="{{ route('setCurrency', $currency->code) }}">{{ $currency->code }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        @yield('content')
		<!-- all js here -->
        @yield('footer_script')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>
</html>
