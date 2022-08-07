@extends('../admin/main')

@section('title') Создние продукта @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>Создние продукта для категории {{ $category->name_ru.'/'.$category->name_en }}</h2>
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name_ru" class="form-label">Название продукта (ru)</label>
            @error('name_ru')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name_ru" name="name_ru" @isset($product) value="{{ $product->name_ru }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="name_en" class="form-label">Название продукта (en)</label>
            @error('name_en')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name_en" name="name_en" @isset($product) value="{{ $product->name_en }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="description_ru" class="form-label">Описание продукта (ru)</label>
            @error('description_ru')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <textarea class="form-control" id="description_ru" name="description_ru" rows="3">@isset($product) {{ $product->description_ru }} @endisset</textarea>
        </div>
        <div class="mb-3">
            <label for="description_en" class="form-label">Описание продукта (en)</label>
            @error('description_en')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <textarea class="form-control" id="description_en" name="description_en" rows="3">@isset($product) {{ $product->description_en }} @endisset</textarea>
        </div>
        <div class="mb-3">
            <label for="property_id" class="form-label">Свойства</label>
            <select name="property_id[]" class="form-select" id="property_id" multiple size="5">
                @foreach ($properties as $property)
                <option value="{{ $property->id }}" {{ (isset($product) && $product->property_id == $property->id)? 'selected': '' }}>{{ $property->id }} - {{ $property->name_ru.'/'.$property->name_en }}</option>
                @endforeach
            </select>
            @error('property_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Изображение</label>
            <input type="file" class="form-control" id="img" name="img">
            @error('img')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        @csrf
        
        <input type="hidden" name="category_id" value="{{ $category->id }}">
        <button type="submit" class="btn btn-primary">Создать</button>
        <a class="btn btn-success" href="{{ route('product.index') }}">К списку продуктов</a>
    </form>
@endsection