@extends('../admin/main')

@section('title') @lang('headers.options') @endsection

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
    <h2>@lang('headers.options')</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('property_option.create') }}">@lang('btn.create')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.name_ru')</th>
            <th>@lang('tables.name_en')</th>
            <th></th>
        </tr>
        @foreach ($propertyOptions as $option)
            <tr>
                <td><a href="{{ route('property_option.show', $option) }}" class="btn btn-info">{{ $option->name_ru }}</a></td>
                <td><a href="{{ route('property_option.show', $option) }}" class="btn btn-info">{{ $option->name_en }}</a></td>
                <td>
                    <a href="{{ route('property_option.edit', $option) }}" class="btn btn-warning d-inline-block">@lang('btn.update')</a>
                    <form action="{{ route('property_option.destroy', $option) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">@lang('btn.delete')</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $propertyOptions->links() }}
@endsection