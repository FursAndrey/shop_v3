@extends('../shop/main')

@section('title') @lang('headers.product_cart') @endsection

@section('content')
    <h2 class="text-center">@lang('headers.product_cart')</h2>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <img src="{{ $product->img_for_view }}" alt="изображение не добавлено" style="max-width: 200px;">
            </div>
            <div class="col-9">
                <h4>{{ $product->name }}</h4>
                <p>{{ $product->description }}</p>
            </div>
        </div>
        <p class="mt-5">@lang('tables.skus'):</p>
        @foreach ($skus as $sku)
            <div class="row mb-3">
                <div class="col-3">@lang('tables.id_sku'): {{ $sku->id_for_view }}</div>
                <div class="col-4">
                    @if(isset($sku->property_options))
                        @foreach ($sku->property_options as $propertyOption)
                            {{ $propertyOption->property->name }}: {{ $propertyOption->name }}<br/>
                        @endforeach
                    @else
                        -
                    @endif
                </div>
                <div class="col-3">
                    {{ $sku->price }} {{ $sku->cur_code }}
                </div>
                <div class="col-2">
                    <form action="{{ route('addToBasket', $sku) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success" title="@lang('btn.add_to_basket')">
                            @lang('btn.add_to_basket')
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection