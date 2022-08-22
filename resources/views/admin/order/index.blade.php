@extends('../admin/main')

@section('title') Заказы @endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success ">
            <p class="text-center">{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('warning'))
        <div class="alert alert-warning ">
            <p class="text-center">{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('danger'))
        <div class="alert alert-danger ">
            <p class="text-center">{{ $message }}</p>
        </div>
    @endif
    <h2>Заказы</h2>
    <table class="table table-striped table-hover">
        <tr>
            <th>ID</th>
            <th>Имя пользователя</th>
            <th>Email</th>
            <th>Коментарий</th>
            <th>Сумма заказа</th>
            <th>Статус</th>
            <th></th>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td><a href="{{ route('order.show', $order) }}" class="btn btn-info">{{ $order->id }}</a></td>
                <td>{{ $order->user_name }}</td>
                <td>{{ $order->user_email }}</td>
                <td>{{ $order->description }}</td>
                <td>{{ $order->total_price }} {{ $order->currency_code }}</td>
                <td>
                    @if ($order->status == 0)
                        <span class="text-warning border border-warning p-1 rounded">@lang('btn.order_accepted')</span>
                    @elseif ($order->status == 1)
                        <span class="text-success border border-success p-1 rounded">@lang('btn.order_complited')</span>
                    @else
                        <span class="text-danger border border-danger p-1 rounded">@lang('btn.order_cenceled')</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('order.success', $order) }}" method="POST" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-success">@lang('btn.order_complited')</button>
                    </form>
                    <form action="{{ route('order.cencel', $order) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">@lang('btn.order_cenceled')</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection