@extends('../admin/main')

@section('title') @lang('headers.products') @endsection

@section('header_styles')
@endsection

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
    <h2>@lang('headers.products')</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('product.create') }}">@lang('btn.create')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.img')</th>
            <th>@lang('tables.name_ru')</th>
            <th>@lang('tables.name_en')</th>
            <th>@lang('tables.description_ru')</th>
            <th>@lang('tables.description_en')</th>
            <th>@lang('tables.id_sku')</th>
            <th></th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td><a href="{{ route('product.show', $product) }}"><img src="{{ $product->img_for_view }}" alt="изображение не добавлено" style="width: 100px;"></a></td>
                <td><a href="{{ route('product.show', $product) }}" class="btn btn-info">{{ $product->name_ru }}</a></td>
                <td><a href="{{ route('product.show', $product) }}" class="btn btn-info">{{ $product->name_en }}</a></td>
                <td>{{ $product->description_ru }}</td>
                <td>{{ $product->description_en }}</td>
                <td>
                    @foreach ($product->skus as $sku)
                        {{ $sku->id_for_view }}<br/>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('product.edit', $product) }}" class="btn btn-warning d-inline-block">@lang('btn.update')</a>
                    <a href="{{ route('sku.create_for_product', $product) }}" class="btn btn-primary d-inline-block">@lang('btn.add_sku')</a>
                    <form action="{{ route('product.destroy', $product) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">@lang('btn.delete')</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $products->links() }}
@endsection