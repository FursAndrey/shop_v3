@extends('../admin/main')

@section('title') @lang('headers.option') @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>@lang('headers.option') {{ $propertyOption->name }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('property_option.index') }}">@lang('btn.return_to_options')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.name')</th>
            <th>@lang('tables.value')</th>
        </tr>
        <tr>
            <td>@lang('tables.name_ru')</td>
            <td>{{ $propertyOption->name_ru }}</td>
        </tr>
        <tr>
            <td>@lang('tables.name_en')</td>
            <td>{{ $propertyOption->name_en }}</td>
        </tr>
        <tr>
            <td>@lang('tables.name')</td>
            <td>{{ $propertyOption->property->name }}</td>
        </tr>
    </table>
@endsection