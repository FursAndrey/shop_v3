@extends('../admin/main')

@section('title') Свойство @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>Свойство {{ $property->name_ru }}/{{ $property->name_en }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('property.index') }}">@lang('btn.return_to_properties')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.name')</th>
            <th>@lang('tables.value')</th>
        </tr>
        <tr>
            <td>@lang('tables.name_ru')</td>
            <td>{{ $property->name_ru }}</td>
        </tr>
        <tr>
            <td>@lang('tables.name_en')</td>
            <td>{{ $property->name_en }}</td>
        </tr>
        <tr>
            <td>@lang('tables.option')</td>
            <td>
                @foreach ($property->propertyOptions as $propertyOption)
                    {{ $propertyOption->name }}<br/>
                @endforeach
            </td>
        </tr>
    </table>
@endsection