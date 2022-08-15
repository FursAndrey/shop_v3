    @extends('../admin/main')

@section('title') Заказ @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>Заказ {{ $order->id }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('order.index') }}">К списку заказов</a>
    <table class="table table-striped table-hover">
        <tr>
            <th colspan="2">Название</th>
            <th colspan="2">Значение</th>
        </tr>
        <tr>
            <td colspan="2">ID заказа</td>
            <td colspan="2">{{ $order->id }}</td>
        </tr>
        <tr>
            <td colspan="2">Имя пользователя</td>
            <td colspan="2">{{ $order->user_name }}</td>
        </tr>
        <tr>
            <td colspan="2">Email пользователя</td>
            <td colspan="2">{{ $order->user_email }}</td>
        </tr>
        <tr>
            <td colspan="2">Описание заказа</td>
            <td colspan="2">{{ $order->description }}</td>
        </tr>
        <tr>
            <td colspan="2">Сумма заказа</td>
            <td colspan="2">{{ $order->total_price }} {{ $order->currency_code }}</td>
        </tr>
        <tr>
            <td colspan="2">Статус заказа</td>
            <td colspan="2">
                @if ($order->status == 0)
                    <span class="text-warning border border-warning p-1 rounded">Заказ принят</span>
                @elseif ($order->status == 1)
                    <span class="text-success border border-success p-1 rounded">Заказ выдан</span>
                @else
                    <span class="text-danger border border-danger p-1 rounded">Заказ отменен</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Название товара</th>
            <th>№ СКУ</th>
            <th>Цена за ед.</th>
            <th>Количество</th>
        </tr>
        @foreach ($order->orderedProducts as $product)
            <tr>
                <td>{{ $product->name_ru }}/{{ $product->name_en }}</td>
                <td>{{ $product->sku_id }}</td>
                <td>{{ $product->price_for_once }} {{ $order->currency_code }}</td>
                <td>{{ $product->count }}</td>
            </tr>
        @endforeach
    </table>
@endsection