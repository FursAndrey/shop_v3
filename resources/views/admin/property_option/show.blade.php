@extends('../admin/main')

@section('title') Значение свойства @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>Значение свойства {{ $propertyOption->name_ru }}/{{ $propertyOption->name_en }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('property_option.index') }}">@lang('btn.return_to_options')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>Название</th>
            <th>Значение</th>
        </tr>
        <tr>
            <td>Название RU</td>
            <td>{{ $propertyOption->name_ru }}</td>
        </tr>
        <tr>
            <td>Название EN</td>
            <td>{{ $propertyOption->name_en }}</td>
        </tr>
        <tr>
            <td>Название свойства</td>
            <td>{{ $propertyOption->property->name_ru }}/{{ $propertyOption->property->name_en }}</td>
        </tr>
    </table>
@endsection