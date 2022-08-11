@extends('../shop/main')

@section('title') Карта товара @endsection

@section('content')
    <h2 class="text-center">Карта товара</h2>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <img src="{{ $sku->product->img_for_view }}" alt="изображение не добавлено" style="max-width: 200px;">
            </div>
            <div class="col-9">
                <h4>{{ $sku->product->name_ru }}/{{ $sku->product->name_en }}</h4>
                <p>SKU: {{ $sku->id }}</p>
                <p>{{ $sku->product->description_ru }}/{{ $sku->product->description_en }}</p>
                <p>{{ $sku->price }} {{ $sku->currency->code }}</p>
                <a class="btn btn-success" href="#">Добавить в корзину</a>
            </div>
        </div>
        <p class="mt-5">Характеристики:</p>
        @foreach ($sku->product->properties as $property)
            <div class="row">
                <div class="col-3">{{ $property->name_ru }}/{{ $property->name_en }}</div>
                <div class="col-9">
                    @if(isset($sku->property_options))
                        @foreach ($sku->property_options as $propertyOption)
                            @if ($propertyOption->property->id == $property->id)
                                {{ $propertyOption->name_ru }}/{{ $propertyOption->name_en }}
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