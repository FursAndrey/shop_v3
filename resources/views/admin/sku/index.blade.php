@extends('../admin/main')

@section('title') СКУ @endsection

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
    <h2>СКУ</h2>
    <a class="btn btn-success" href="{{ route('sku.create') }}">Добавить СКУ</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>ID ску</th>
            <th>Товар</th>
            <th>Цена</th>
            <th>Валюта</th>
            <th>Количество</th>
            <th>Свойство</th>
            <th>Значение</th>
            <th></th>
        </tr>
        @foreach ($skus as $sku)
            <tr>
                <td><a href="{{ route('sku.show', $sku) }}" class="btn btn-info">{{ $sku->id }}</a></td>
                <td>{{ $sku->product->name_ru }}/{{ $sku->product->name_en }}</td>
                <td>{{ $sku->price }}</td>
                <td>{{ $sku->currency->code }}</td>
                <td>{{ $sku->count }}</td>
                <td>
                    @foreach ($sku->product->properties as $property)
                        {{ $property->name_ru }}/{{ $property->name_en }}<br/>
                    @endforeach
                </td>
                <td>
                    @foreach ($sku->product->properties as $property)
                        @if(isset($sku->property_options))
                            @foreach ($sku->property_options as $propertyOption)
                                @if ($propertyOption->property->id == $property->id)
                                    {{ $propertyOption->name_ru }}/{{ $propertyOption->name_en }}<br/>
                                @endif
                            @endforeach
                        @else
                            -
                        @endif
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('sku.edit', $sku) }}" class="btn btn-warning d-inline-block">Редактировать</a>
                    <form action="{{ route('sku.destroy', $sku) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $skus->links() }}
@endsection