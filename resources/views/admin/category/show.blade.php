@extends('../admin/main')

@section('title') Категории @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>Категория {{ $category->name_ru }}/{{ $category->name_en }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('category.index') }}">К списку категорий</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>Название</th>
            <th>Значение</th>
        </tr>
        <tr>
            <td>Код</td>
            <td>{{ $category->code }}</td>
        </tr>
        <tr>
            <td>Название RU</td>
            <td>{{ $category->name_ru }}</td>
        </tr>
        <tr>
            <td>Название EN</td>
            <td>{{ $category->name_en }}</td>
        </tr>
        <tr>
            <td>Описание RU</td>
            <td>{{ $category->description_ru }}</td>
        </tr>
        <tr>
            <td>Описание EN</td>
            <td>{{ $category->description_en }}</td>
        </tr>
    </table>
@endsection