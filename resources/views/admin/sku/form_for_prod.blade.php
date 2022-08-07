@extends('../admin/main')

@section('title') Создние @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>Создние СКУ продукта {{ $product->name_ru.'/'.$product->name_en }}</h2>
    <form action="{{ route('sku.store') }}" method="POST">
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="mb-3">
            <label for="currency_id" class="form-label">Продукт</label>
            <select name="currency_id" class="form-select" id="currency_id">
                @foreach ($currencies as $currency)
                <option value="{{ $currency->id }}">{{ $currency->code }}</option>
                @endforeach
            </select>
            @error('currency_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            @error('price')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="price" name="price">
        </div>
        <div class="mb-3">
            <label for="count" class="form-label">Колчество</label>
            @error('count')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="count" name="count">
        </div>
        @isset($product)
            @foreach ($product->properties as $property)
                <div class="mb-3">
                    <label for="property_option_id" class="form-label">Свойство {{ $property->name_ru }}/{{ $property->name_en }}</label>
                    <select name="property_option_id[]" class="form-select" id="property_option_id">
                        @foreach ($property->propertyOptions as $propertyOption)
                        <option value="{{ $propertyOption->id }}" {{ (isset($sku) && $sku->property_option_id == $propertyOption->id)? 'selected': '' }}>{{ $propertyOption->name_ru }}/{{ $propertyOption->name_en }}</option>
                        @endforeach
                    </select>
                    @error('property_option_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach
        @endisset
        @csrf
        
        <button type="submit" class="btn btn-primary">Создать</button>
        <a class="btn btn-success" href="{{ route('sku.index') }}">К списку СКУ</a>
    </form>
@endsection