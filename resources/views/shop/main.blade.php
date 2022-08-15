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
		<!-- all css here -->
        @yield('header_styles')
    </head>
    <body class="m-3">
        <div>
            <a class="m-2 btn btn-secondary" href="{{ route('skuListPage') }}">Главная</a>
            <a class="m-2 btn btn-secondary" href="{{ route('showBasket') }}">Корзина</a>
            @auth
            <a class="m-2 btn btn-secondary" href="{{ route('category.index') }}">Админка</a>
            @endauth
            @guest
                <a href="{{ route('register') }}" class="m-2 btn btn-secondary">Регистрация</a>
            @endguest
            @auth
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" title="Выйти" class="m-2 btn btn-secondary">X</button>
                </form>
            @endauth
        </div>
        @yield('content')
		<!-- all js here -->
        @yield('footer_script')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>
</html>
