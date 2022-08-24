@extends('../admin/main')

@section('title') Создние/Редактирование продукта @endsection

@section('header_styles')
@endsection

@section('content')
    @if (isset($product))
        <h2>Редактирование продукта {{ $product->code }}</h2>
        <form action="{{ route('product.update', $product) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
    @else
        <h2>Создние продукта</h2>
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @endif
        <div class="mb-3">
            <label for="name_ru" class="form-label">@lang('tables.name_ru')</label>
            @error('name_ru')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name_ru" name="name_ru" @isset($product) value="{{ $product->name_ru }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="name_en" class="form-label">@lang('tables.name_en')</label>
            @error('name_en')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name_en" name="name_en" @isset($product) value="{{ $product->name_en }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="description_ru" class="form-label">@lang('tables.description_ru')</label>
            @error('description_ru')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <textarea class="form-control" id="description_ru" name="description_ru" rows="3">@isset($product) {{ $product->description_ru }} @endisset</textarea>
        </div>
        <div class="mb-3">
            <label for="description_en" class="form-label">@lang('tables.description_en')</label>
            @error('description_en')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <textarea class="form-control" id="description_en" name="description_en" rows="3">@isset($product) {{ $product->description_en }} @endisset</textarea>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Категория</label>
            <select name="category_id" class="form-select" id="category_id">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ (isset($product) && $product->category_id == $category->id)? 'selected': '' }}>{{ $category->id }} - {{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="property_id" class="form-label">@lang('tables.property')</label>
            <select name="property_id[]" class="form-select" id="property_id" multiple size="5">
                @foreach ($properties as $property)
                <option value="{{ $property->id }}" {{ (isset($product) && $product->property_id == $property->id)? 'selected': '' }}>{{ $property->id }} - {{ $property->name }}</option>
                @endforeach
            </select>
            @error('property_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">@lang('tables.img')</label>
            <input type="file" class="form-control" id="img" name="img">
            @error('img')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        @csrf
        
        @if (isset($product))
            <button type="submit" class="btn btn-primary">@lang('btn.update')</button>
        @else
            <button type="submit" class="btn btn-primary">@lang('btn.create')</button>
        @endif
        <a class="btn btn-success" href="{{ route('product.index') }}">@lang('btn.return_to_products')</a>
    </form>
@endsection