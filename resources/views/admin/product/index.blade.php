@extends('../admin/main')

@section('title') Продукты @endsection

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
    <h2>Продукты</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('product.create') }}">Добавить продукт</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>Ивображение</th>
            <th>Название RU</th>
            <th>Название EN</th>
            <th>Описание RU</th>
            <th>Описание EN</th>
            <th>СКУ</th>
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
                        {{ $sku->id }}<br/>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('product.edit', $product) }}" class="btn btn-warning d-inline-block">Редактировать</a>
                    <a href="{{ route('sku.create_for_product', $product) }}" class="btn btn-primary d-inline-block">Добавить СКУ</a>
                    <form action="{{ route('product.destroy', $product) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $products->links() }}
@endsection