@extends('../shop/main')

@section('title') Корзина @endsection

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
    <h2>Корзина</h2>
    <table class="table table-striped table-hover">
        <tr>
            <th>ID ску</th>
            <th>Товар</th>
            <th>Цена за 1</th>
            <th>Цена</th>
            <th>Кол-во в заказе</th>
            <th>Кол-во на складе</th>
            <th>Характеристики</th>
            <th></th>
        </tr>
        @php
            $totalPrice = 0;
        @endphp
        @foreach ($basket as $sku)
            @php
                $priceInBasket = $sku->price*$sku->countInBasket;
                $totalPrice += $priceInBasket;
            @endphp
            <tr>
                <td>{{ $sku->id }}</td>
                <td>
                    <p><a href="{{ route('sku.show', $sku) }}"><img src="{{ $sku->product->img_for_view }}" alt="изображение не добавлено" style="max-width: 100px;"></a></p>
                    <p><a href="{{ route('sku.show', $sku) }}" class="btn btn-info">{{ $sku->product->name_ru }}/{{ $sku->product->name_en }}</a></p>
                </td>
                <td>{{ $sku->price }} {{ $sku->cur_code }}</td>
                <td>{{ $priceInBasket }} {{ $sku->cur_code }}</td>
                <td>
                    @if ($sku->countInBasket < $sku->count)
                        <form action="{{ route('addToBasket', $sku) }}" method="POST" class="d-inline-block">
                            @csrf
                            <button type="submit" class="btn btn-success" title="@lang('btn.add_to_basket')">
                                +
                            </button>
                        </form>
                    @else
                        <span class="d-inline-block btn btn-secondary" title="@lang('btn.not_available')">+</span>
                    @endif
                    <span class="ms-3 me-3">{{ $sku->countInBasket }}</span>
                    <form action="{{ route('removeFromBasket', $sku) }}" method="POST" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-warning" title="@lang('btn.remove_from_basket')">
                            -
                        </button>
                    </form>
                </td>
                <td>не более {{ $sku->count }}</td>
                <td>
                    @foreach ($sku->product->properties as $property)
                        {{ $property->name_ru }}/{{ $property->name_en }}:
                        @if(isset($sku->property_options))
                            @foreach ($sku->property_options as $propertyOption)
                                @if ($propertyOption->property->id == $property->id)
                                    {{ $propertyOption->name_ru }}/{{ $propertyOption->name_en }}<br/>
                                @endif
                            @endforeach
                        @else
                            -
                        @endif
                    @endforeach
                </td>
                <td>
                    <form action="{{ route('remuveThisSkuFromBasket', $sku) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" title="@lang('btn.remove_from_basket')">
                            Х
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <p><b>Общая сумма заказа</b> {{ $totalPrice }}{{ $sku->cur_code }}</p>
    <a href="{{ route('confirmOrderForm') }}" class="btn btn-success">@lang('btn.create_order')</a>
    <form action="{{ route('clearBasket') }}" method="POST" class="d-inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" title="@lang('btn.clear_basket')">
            @lang('btn.clear_basket')
        </button>
    </form>
@endsection