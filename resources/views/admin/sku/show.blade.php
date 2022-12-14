    @extends('../admin/main')

@section('title') @lang('headers.sku') @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>@lang('headers.sku') {{ $sku->id_for_view }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('sku.index') }}">@lang('btn.return_to_skus')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.name')</th>
            <th>@lang('tables.value')</th>
        </tr>
        <tr>
            <td>@lang('tables.id_sku')</td>
            <td>{{ $sku->id_for_view }}</td>
        </tr>
        <tr>
            <td>@lang('tables.price_for_once')</td>
            <td>{{ $sku->price }}</td>
        </tr>
        <tr>
            <td>@lang('tables.count_in_stoke')</td>
            <td>{{ $sku->count }}</td>
        </tr>
        <tr>
            <td>@lang('tables.product')</td>
            <td>{{ $sku->product->name }}</td>
        </tr>
        <tr>
            <td><b>@lang('tables.property')</b></td>
            <td><b>@lang('tables.option')</b></td>
        </tr>
        @foreach ($sku->product->properties as $property)
            <tr>
                <td>{{ $property->name }}</td>
                <td>
                    @if(isset($sku->property_options))
                        @foreach ($sku->property_options as $propertyOption)
                            @if ($propertyOption->property->id == $property->id)
                                {{ $propertyOption->name }}
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