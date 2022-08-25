<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>@lang('headers.order')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset("favicon.ico") }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<!-- all css here -->
        <style>
            body {
                font-family: 'Arial' !important;
            }

            td {
                border: 1px solid silver;
            }
        </style>
    </head>
    <body class="m-3">
        @if (!$isPDF)
            <div>
                <a @route_active('skuListPage') href="{{ route('skuListPage') }}">@lang('btn.home')</a>
                <a @route_active('showBasket') href="{{ route('showBasket') }}">@lang('btn.basket')</a>
                @auth
                    <a @route_active('category.index') href="{{ route('category.index') }}">@lang('btn.admin_panel')</a>
                @endauth
                @guest
                    <a href="{{ route('login') }}" @route_active('login')>@lang('btn.login')</a>
                @endguest
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" title="Выйти" @route_active('logout')>@lang('btn.logout')</button>
                    </form>
                @endauth
            </div>
        @endif
        
        <h2>@lang('headers.order') {{ $order->id }}</h2>
        <table @if (!$isPDF) class="table table-striped table-hover"@endif>
            <tr>
                <td colspan="2">@lang('tables.id_order')</td>
                <td colspan="3">{{ $order->id }}</td>
            </tr>
            <tr>
                <td colspan="2">@lang('tables.login')</td>
                <td colspan="3">{{ $order->user_name }}</td>
            </tr>
            <tr>
                <td colspan="2">@lang('tables.email')</td>
                <td colspan="3">{{ $order->user_email }}</td>
            </tr>
            <tr>
                <td colspan="2">@lang('tables.description')</td>
                <td colspan="3">{{ $order->description }}</td>
            </tr>
            <tr>
                <td colspan="2">@lang('tables.total_price')</td>
                <td colspan="3">{{ $order->total_price }} {{ $order->currency_code }}</td>
            </tr>
            <tr>
                <td colspan="2">@lang('tables.status')</td>
                <td colspan="3">
                    @if ($order->status == 0)
                        <span @if (!$isPDF)class="text-warning border border-warning p-1 rounded"@endif>@lang('btn.order_accepted')</span>
                    @elseif ($order->status == 1)
                        <span @if (!$isPDF)class="text-success border border-success p-1 rounded"@endif>@lang('btn.order_complited')</span>
                    @else
                        <span @if (!$isPDF)class="text-danger border border-danger p-1 rounded"@endif>@lang('btn.order_cenceled')</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>@lang('tables.product')</th>
                <th>@lang('tables.id_sku')</th>
                <th>@lang('tables.price_for_once')</th>
                <th>@lang('tables.count_in_order')</th>
                <th>@lang('tables.parameters')</th>
            </tr>
            @foreach ($order->orderedProducts as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->sku_id }}</td>
                    <td>{{ $product->price_for_once }} {{ $order->currency_code }}</td>
                    <td>{{ $product->count }}</td>
                    <td>
                        @foreach ($product->orderedProperties as $property)
                            {{ $property->property_name }} => {{ $property->option_name }}<br/>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </table>
        @if (!$isPDF)
            <a href="{{ route('checkLoad', $order) }}" class="btn btn-primary">@lang('btn.get_check')</a>
        @endif
    </body>
</html>