@extends('../shop/main')

@section('title') @lang('headers.sku_cart') @endsection

@section('content')
    <h2 class="text-center">@lang('headers.sku_cart')</h2>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <img src="{{ $sku->product->img_for_view }}" alt="изображение не добавлено" style="max-width: 200px;">
            </div>
            <div class="col-9">
                <h4>{{ $sku->product->name }}</h4>
                <p>@lang('tables.id_sku'): {{ $sku->id }}</p>
                <p>{{ $sku->product->description }}</p>
                <p>{{ $sku->price }} {{ $sku->cur_code }}</p>
                @if ($sku->count > 0)
                    <form action="{{ route('addToBasket', $sku) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success" title="@lang('btn.add_to_basket')">
                            @lang('btn.add_to_basket')
                        </button>
                    </form>
                @else
                    <p class="btn btn-danger">@lang('btn.not_available_for_order')</p>
                @endif
            </div>
        </div>
        <p class="mt-5">@lang('tables.parameters'):</p>
        @foreach ($sku->product->properties as $property)
            <div class="row">
                <div class="col-3">{{ $property->name }}</div>
                <div class="col-9">
                    @if(isset($sku->property_options))
                        @foreach ($sku->property_options as $propertyOption)
                            @if ($propertyOption->property->id == $property->id)
                                {{ $propertyOption->name }}
                            @endif
                        @endforeach
                    @else
                        -
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection