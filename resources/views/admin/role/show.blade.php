@extends('../admin/main')

@section('title') Роль @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>Роль {{ $role->name_ru }}/{{ $role->name_en }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('role.index') }}">@lang('btn.return_to_roles')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.name')</th>
            <th>@lang('tables.value')</th>
        </tr>
        <tr>
            <td>@lang('tables.name_ru')</td>
            <td>{{ $role->name_ru }}</td>
        </tr>
        <tr>
            <td>@lang('tables.name_en')</td>
            <td>{{ $role->name_en }}</td>
        </tr>
        <tr>
            <td>@lang('tables.description_ru')</td>
            <td>{{ $role->description_ru }}</td>
        </tr>
        <tr>
            <td>@lang('tables.description_en')</td>
            <td>{{ $role->description_en }}</td>
        </tr>
    </table>
@endsection