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
            @if((Illuminate\Support\Facades\Auth::user())->isAdmin())
                <a @route_active('skuListPage') href="{{ route('skuListPage') }}">@lang('btn.home')</a>
                <a @route_active('currency.index') href="{{ route('currency.index') }}">@lang('btn.currencies')</a>
                <a @route_active('category.index') href="{{ route('category.index') }}">@lang('btn.categories')</a>
                <a @route_active('product.index') href="{{ route('product.index') }}">@lang('btn.products')</a>
            @endif
            <a @route_active('sku.index') href="{{ route('sku.index') }}">@lang('btn.skus')</a>
            @if((Illuminate\Support\Facades\Auth::user())->isAdmin())
                <a @route_active('property.index') href="{{ route('property.index') }}">@lang('btn.properties')</a>
                <a @route_active('property_option.index') href="{{ route('property_option.index') }}">@lang('btn.options')</a>
                <a @route_active('role.index') href="{{ route('role.index') }}">@lang('btn.roles')</a>
                <a @route_active('user.index') href="{{ route('user.index') }}">@lang('btn.users')</a>
                <a @route_active('order.index') href="{{ route('order.index') }}">@lang('btn.orders')</a>
                <a class="btn btn-warning" href="{{ route('resetProject') }}">@lang('btn.reset')</a>
            @endif
            @guest
                <a href="{{ route('login') }}" class="btn btn-success">@lang('btn.login')</a>
            @endguest
            @auth
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" title="Выйти" class="btn btn-danger">@lang('btn.logout')</button>
                </form>
            @endauth
            <div class="head-menu">
                <a class="m-2 btn btn-info" href="#">{{ strtoupper(session('locale', 'RU')) }}</a>
                <ul>
                    <li><a class="m-2 btn btn-info" href="{{ route('setLocale', 'ru') }}">RU</a></li>
                    <li><a class="m-2 btn btn-info" href="{{ route('setLocale', 'en') }}">EN</a></li>
                </ul>
            </div>
        </div>
        @yield('content')
		<!-- all js here -->
        @yield('footer_script')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>
</html>
