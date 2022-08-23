@extends('../admin/main')

@section('title') Свойства @endsection

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
    <h2>Свойства</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('property.create') }}">@lang('btn.create')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.name_ru')</th>
            <th>@lang('tables.name_en')</th>
            <th>@lang('tables.option')</th>
            <th></th>
        </tr>
        @foreach ($properties as $property)
            <tr>
                <td><a href="{{ route('property.show', $property) }}" class="btn btn-info">{{ $property->name_ru }}</a></td>
                <td><a href="{{ route('property.show', $property) }}" class="btn btn-info">{{ $property->name_en }}</a></td>
                <td>
                    @foreach ($property->propertyOptions as $propertyOption)
                        {{ $propertyOption->name_ru }}/{{ $propertyOption->name_en }}<br/>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('property.edit', $property) }}" class="btn btn-warning d-inline-block">@lang('btn.update')</a>
                    <a href="{{ route('property_option.create_for_property', $property) }}" class="btn btn-primary d-inline-block">@lang('btn.add_option')</a>
                    <form action="{{ route('property.destroy', $property) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">@lang('btn.delete')</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $properties->links() }}
@endsection