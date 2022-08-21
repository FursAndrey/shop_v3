<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Заказ</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset("favicon.ico") }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<!-- all css here -->
        <style>
            body {
                font-family: 'Arial' !important;
                background: #f3eeff;
            }

            td {
                border: 1px solid silver;
            }
        </style>
    </head>
    <body class="m-3">
        @if (!$isPDF)
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
            </div>
        @endif
        
        <h2>Заказ {{ $order->id }}</h2>
        <table class="table table-striped table-hover">
            <tr>
                <td colspan="2">ID заказа</td>
                <td colspan="3">{{ $order->id }}</td>
            </tr>
            <tr>
                <td colspan="2">Имя пользователя</td>
                <td colspan="3">{{ $order->user_name }}</td>
            </tr>
            <tr>
                <td colspan="2">Email пользователя</td>
                <td colspan="3">{{ $order->user_email }}</td>
            </tr>
            <tr>
                <td colspan="2">Описание заказа</td>
                <td colspan="3">{{ $order->description }}</td>
            </tr>
            <tr>
                <td colspan="2">Сумма заказа</td>
                <td colspan="3">{{ $order->total_price }} {{ $order->currency_code }}</td>
            </tr>
            <tr>
                <td colspan="2">Статус заказа</td>
                <td colspan="3">
                    @if ($order->status == 0)
                        <span @if (!$isPDF)class="text-warning border border-warning p-1 rounded"@endif>Заказ принят</span>
                    @elseif ($order->status == 1)
                        <span @if (!$isPDF)class="text-success border border-success p-1 rounded"@endif>Заказ выдан</span>
                    @else
                        <span @if (!$isPDF)class="text-danger border border-danger p-1 rounded"@endif>Заказ отменен</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Название товара</th>
                <th>№ СКУ</th>
                <th>Цена за ед.</th>
                <th>Количество</th>
                <th>Свойства</th>
            </tr>
            @foreach ($order->orderedProducts as $product)
                <tr>
                    <td>{{ $product->name_ru }}/{{ $product->name_en }}</td>
                    <td>{{ $product->sku_id }}</td>
                    <td>{{ $product->price_for_once }} {{ $order->currency_code }}</td>
                    <td>{{ $product->count }}</td>
                    <td>
                        @foreach ($product->orderedProperties as $property)
                            {{ $property->property_name_ru }}/{{ $property->property_name_en }} => {{ $property->option_name_ru }}/{{ $property->option_name_en }}<br/>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </table>
        @if (!$isPDF)
            <a href="{{ route('checkLoad', $order) }}" class="btn btn-primary">Скачать чек</a>
        @endif
    </body>
</html>