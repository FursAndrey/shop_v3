    @extends('../admin/main')

@section('title') @lang('headers.order') @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>@lang('headers.order') {{ $order->id }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('order.index') }}">@lang('btn.return_to_orders')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th colspan="2">@lang('tables.name')</th>
            <th colspan="3">@lang('tables.value')</th>
        </tr>
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
                    <span class="text-warning border border-warning p-1 rounded">@lang('btn.order_accepted')</span>
                @elseif ($order->status == 1)
                    <span class="text-success border border-success p-1 rounded">@lang('btn.order_complited')</span>
                @else
                    <span class="text-danger border border-danger p-1 rounded">@lang('btn.order_cenceled')</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>@lang('tables.products')</th>
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
    <p>
        <form action="{{ route('order.success', $order) }}" method="POST" class="d-inline-block">
            @csrf
            <button type="submit" class="btn btn-success">@lang('btn.order_complited')</button>
        </form>
        <form action="{{ route('order.cencel', $order) }}" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">@lang('btn.order_cenceled')</button>
        </form>
    </p>
@endsection