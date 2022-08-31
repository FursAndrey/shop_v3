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
        <!--Plugin CSS file with desired skin-->
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/ion.rangeSlider.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/custom.css') }}">
		<!-- all css here -->
        @yield('header_styles')
    </head>
    <body class="m-3">
        <div class="mb-4">
            <a @route_active('skuListPage') href="{{ route('skuListPage') }}">@lang('btn.home')</a>
            <div class="head-menu">
                <a class="m-2 btn btn-info" href="#">@lang('btn.categories')</a>
                <ul>
                    @foreach ($categories as $category)
                        <li><a class="btn btn-info" href="{{ route('skuListPage', $category) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <a @route_active('showBasket') href="{{ route('showBasket') }}">@lang('btn.basket')</a>
            @auth
            <a @route_active('category.index') href="{{ route('category.index') }}">@lang('btn.admin_panel')</a>
            @endauth
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
                <a class="m-2 btn btn-info" href="#">{{ session('currency', 'BYN') }}</a>
                <ul>
                    @foreach ($currencies as $currency)
                        <li><a class="btn btn-info" href="{{ route('setCurrency', $currency->code) }}">{{ $currency->code }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="head-menu">
                <a class="m-2 btn btn-info" href="#">{{ strtoupper(session('locale', 'RU')) }}</a>
                <ul>
                    <li><a class="btn btn-info" href="{{ route('setLocale', 'ru') }}">RU</a></li>
                    <li><a class="btn btn-info" href="{{ route('setLocale', 'en') }}">EN</a></li>
                </ul>
            </div>
        </div>
        @yield('content')
		<!-- all js here -->
        @yield('footer_script')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <!--jQuery-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="{{ asset('/js/ion.rangeSlider.js') }}"></script>
        <script src="{{ asset('/js/custom.js') }}"></script>
    </body>
</html>
