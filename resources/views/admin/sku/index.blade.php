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
    <a class="btn btn-success mt-2 mb-2" href="{{ route('sku.create') }}">@lang('btn.create')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.id_sku')</th>
            <th>@lang('tables.product')</th>
            <th>@lang('tables.price_for_once')</th>
            <th>@lang('tables.currency')</th>
            <th>@lang('tables.count_in_stoke')</th>
            <th>@lang('tables.property')</th>
            <th>@lang('tables.option')</th>
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
                    <a href="{{ route('sku.edit', $sku) }}" class="btn btn-warning d-inline-block">@lang('btn.update')</a>
                    <form action="{{ route('sku.destroy', $sku) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">@lang('btn.delete')</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $skus->links() }}
@endsection