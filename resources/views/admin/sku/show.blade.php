    @extends('../admin/main')

@section('title') СКУ @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>СКУ {{ $sku->id }}</h2>
    <a class="btn btn-success" href="{{ route('sku.index') }}">К списку СКУ</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>Название</th>
            <th>Значение</th>
        </tr>
        <tr>
            <td>ID ску</td>
            <td>{{ $sku->id }}</td>
        </tr>
        <tr>
            <td>Цена</td>
            <td>{{ $sku->price }}</td>
        </tr>
        <tr>
            <td>Количество</td>
            <td>{{ $sku->count }}</td>
        </tr>
        <tr>
            <td>Продукт</td>
            <td>{{ $sku->product->name_ru }}/{{ $sku->product->name_en }}</td>
        </tr>
        <tr>
            <td><b>Свойство</b></td>
            <td><b>Значение свойства</b></td>
        </tr>
        @foreach ($sku->product->properties as $property)
            <tr>
                <td>{{ $property->name_ru }}/{{ $property->name_en }}</td>
                <td>
                    @if(isset($sku->property_options))
                        @foreach ($sku->property_options as $propertyOption)
                            @if ($propertyOption->property->id == $property->id)
                                {{ $propertyOption->name_ru }}/{{ $propertyOption->name_en }}
                            @endif
                        @endforeach
                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection