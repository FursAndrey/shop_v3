@extends('../admin/main')

@section('title') Роль @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>Роль {{ $role->name_ru }}/{{ $role->name_en }}</h2>
    <a class="btn btn-success" href="{{ route('role.index') }}">К списку продуктов</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>Название</th>
            <th>Значение</th>
        </tr>
        <tr>
            <td>Название RU</td>
            <td>{{ $role->name_ru }}</td>
        </tr>
        <tr>
            <td>Название EN</td>
            <td>{{ $role->name_en }}</td>
        </tr>
        <tr>
            <td>Описание RU</td>
            <td>{{ $role->description_ru }}</td>
        </tr>
        <tr>
            <td>Описание EN</td>
            <td>{{ $role->description_en }}</td>
        </tr>
    </table>
@endsection