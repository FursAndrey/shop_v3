@extends('../admin/main')

@section('title') @lang('headers.product') @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>@lang('headers.product') {{ $product->name }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('product.index') }}">@lang('btn.return_to_products')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.name')</th>
            <th>@lang('tables.value')</th>
        </tr>
        <tr>
            <td>@lang('tables.img')</td>
            <td><img src="{{ $product->img_for_view }}" alt="изображение не добавлено" style="width: 200px;"></td>
        </tr>
        <tr>
            <td>@lang('tables.name_ru')</td>
            <td>{{ $product->name_ru }}</td>
        </tr>
        <tr>
            <td>@lang('tables.name_en')</td>
            <td>{{ $product->name_en }}</td>
        </tr>
        <tr>
            <td>@lang('tables.description_ru')</td>
            <td>{{ $product->description_ru }}</td>
        </tr>
        <tr>
            <td>@lang('tables.description_en')</td>
            <td>{{ $product->description_en }}</td>
        </tr>
        <tr>
            <td>@lang('tables.id_sku')</td>
            <td>
                @foreach ($product->skus as $sku)
                    {{ $sku->id }}<br/>
                @endforeach
            </td>
        </tr>
        <tr>
            <td>@lang('tables.category')</td>
            <td>{{ $product->category->name }}</td>
        </tr>
        <tr>
            <td>@lang('tables.property')</td>
            <td>
                @foreach ($product->properties as $property)
                    {{ $property->name }}<br/>
                @endforeach
            </td>
        </tr>
    </table>
@endsection