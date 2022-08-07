@extends('../admin/main')

@section('title') Категории @endsection

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
    <h2>Категории</h2>
    <a class="btn btn-success" href="{{ route('category.create') }}">Добавить категорию</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>Код</th>
            <th>Название RU</th>
            <th>Название EN</th>
            <th>Описание RU</th>
            <th>Описание EN</th>
            <th>Продукты</th>
            <th></th>
        </tr>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->code }}</td>
                <td><a href="{{ route('category.show', $category) }}" class="btn btn-info">{{ $category->name_ru }}</a></td>
                <td><a href="{{ route('category.show', $category) }}" class="btn btn-info">{{ $category->name_en }}</a></td>
                <td>{{ $category->description_ru }}</td>
                <td>{{ $category->description_en }}</td>
                <td>
                    @foreach ($category->products as $product)
                        {{ $product->name_ru }}/{{ $product->name_en }}<br/>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('category.edit', $category) }}" class="btn btn-warning d-inline-block">Редактировать</a>
                    <a href="{{ route('product.create_for_category', $category) }}" class="btn btn-primary d-inline-block">Добавить продукт</a>
                    <form action="{{ route('category.destroy', $category) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $categories->links() }}
@endsection