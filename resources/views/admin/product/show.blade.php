@extends('../admin/main')

@section('title') Продукт @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>Продукт {{ $product->name_ru }}/{{ $product->name_en }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('product.index') }}">К списку продуктов</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>Название</th>
            <th>Значение</th>
        </tr>
        <tr>
            <td>Изображение</td>
            <td><img src="{{ $product->img_for_view }}" alt="изображение не добавлено" style="width: 200px;"></td>
        </tr>
        <tr>
            <td>Название RU</td>
            <td>{{ $product->name_ru }}</td>
        </tr>
        <tr>
            <td>Название EN</td>
            <td>{{ $product->name_en }}</td>
        </tr>
        <tr>
            <td>Описание RU</td>
            <td>{{ $product->description_ru }}</td>
        </tr>
        <tr>
            <td>Описание EN</td>
            <td>{{ $product->description_en }}</td>
        </tr>
        <tr>
            <td>СКУ</td>
            <td>
                @foreach ($product->skus as $sku)
                    {{ $sku->id }}<br/>
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Категория</td>
            <td>{{ $product->category->name_ru }}/{{ $product->category->name_en }}</td>
        </tr>
        <tr>
            <td>Свойства продукта</td>
            <td>
                @php
                    $properties = $product->properties->toArray();
                @endphp
                @foreach ($properties as $property)
                    {{ $property['name_ru'] }}/{{ $property['name_en'] }}<br/>
                @endforeach
            </td>
        </tr>
    </table>
@endsection