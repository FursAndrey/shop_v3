@extends('../admin/main')

@section('title') Создние/Редактирование СКУ @endsection

@section('header_styles')
@endsection

@section('content')
    @if (isset($sku))
        <h2>Редактирование СКУ {{ $sku->id }}</h2>
        <form action="{{ route('sku.update', $sku) }}" method="POST">
            @method('PUT')
    @else
        <h2>Создние СКУ</h2>
        <form action="{{ route('sku.store') }}" method="POST">
    @endif
        <div class="mb-3">
            <label for="product_id" class="form-label">@lang('tables.product')</label>
            <select name="product_id" class="form-select" id="product_id">
                @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ (isset($sku) && $sku->product_id == $product->id)? 'selected': '' }}>{{ $product->id }} - {{ $product->name_ru.'/'.$product->name_en }}</option>
                @endforeach
            </select>
            @error('product_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="currency_id" class="form-label">@lang('tables.currency')</label>
            <select name="currency_id" class="form-select" id="currency_id">
                @foreach ($currencies as $currency)
                    <option value="{{ $currency->id }}" {{ (isset($sku) && $sku->currency_id == $currency->id)? 'selected': '' }}>{{ $currency->code }}</option>
                @endforeach
            </select>
            @error('currency_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">@lang('tables.price_for_once')</label>
            @error('price')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="price" name="price" @isset($sku) value="{{ $sku->price }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="count" class="form-label">@lang('tables.count_in_stoke')</label>
            @error('count')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="count" name="count" @isset($sku) value="{{ $sku->count }}" @endisset>
        </div>
        @isset($sku)
            @foreach ($sku->product->properties as $property)
                <div class="mb-3">
                    <label for="property_option_id" class="form-label">@lang('tables.property') {{ $property->name_ru }}/{{ $property->name_en }}</label>
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
        
        @if (isset($sku))
            <button type="submit" class="btn btn-primary">@lang('btn.update')</button>
        @else
            <button type="submit" class="btn btn-primary">@lang('btn.create')</button>
        @endif
        <a class="btn btn-success" href="{{ route('sku.index') }}">@lang('btn.return_to_skus')</a>
    </form>
@endsection