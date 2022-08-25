@extends('../admin/main')

@section('title') @lang('headers.categories') @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>@lang('headers.category') {{ $category->name_ru }}/{{ $category->name_en }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('category.index') }}">@lang('btn.return_to_categories')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.name')</th>
            <th>@lang('tables.value')</th>
        </tr>
        <tr>
            <td>@lang('tables.code')</td>
            <td>{{ $category->code }}</td>
        </tr>
        <tr>
            <td>@lang('tables.name_ru')</td>
            <td>{{ $category->name_ru }}</td>
        </tr>
        <tr>
            <td>@lang('tables.name_en')</td>
            <td>{{ $category->name_en }}</td>
        </tr>
        <tr>
            <td>@lang('tables.description_ru')</td>
            <td>{{ $category->description_ru }}</td>
        </tr>
        <tr>
            <td>@lang('tables.description_en')</td>
            <td>{{ $category->description_en }}</td>
        </tr>
    </table>
@endsection