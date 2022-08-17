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
            <a @route_active('skuListPage') href="{{ route('skuListPage') }}">Главная</a>
            <a @route_active('currency.index') href="{{ route('currency.index') }}">Список валют</a>
            <a @route_active('category.index') href="{{ route('category.index') }}">Список категорий</a>
            <a @route_active('product.index') href="{{ route('product.index') }}">Список продуктов</a>
            <a @route_active('sku.index') href="{{ route('sku.index') }}">СКУ</a>
            <a @route_active('property.index') href="{{ route('property.index') }}">Список свойств</a>
            <a @route_active('property_option.index') href="{{ route('property_option.index') }}">Список значений свойств</a>
            <a @route_active('role.index') href="{{ route('role.index') }}">Список ролей пользователей</a>
            <a @route_active('user.index') href="{{ route('user.index') }}">Список пользователей</a>
            <a @route_active('order.index') href="{{ route('order.index') }}">Список заказов</a>
            @guest
                <a href="{{ route('register') }}" @route_active('register')>Регистрация</a>
            @endguest
            @auth
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" title="Выйти" @route_active('logout')>X</button>
                </form>
            @endauth
        </div>
        @yield('content')
		<!-- all js here -->
        @yield('footer_script')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>
</html>
