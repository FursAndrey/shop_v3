@extends('../admin/main')

@section('title') Свойство @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>Свойство {{ $property->name_ru }}/{{ $property->name_en }}</h2>
    <a class="btn btn-success" href="{{ route('property.index') }}">К списку свойств</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>Название</th>
            <th>Значение</th>
        </tr>
        <tr>
            <td>Название RU</td>
            <td>{{ $property->name_ru }}</td>
        </tr>
        <tr>
            <td>Название EN</td>
            <td>{{ $property->name_en }}</td>
        </tr>
        <tr>
            <td>Значения</td>
            <td>
                @foreach ($property->propertyOptions as $propertyOption)
                    {{ $propertyOption->name_ru }}/{{ $propertyOption->name_en }}<br/>
                @endforeach
            </td>
        </tr>
    </table>
@endsection