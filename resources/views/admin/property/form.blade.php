@extends('../admin/main')

@section('title') @lang('headers.create_update_property') @endsection

@section('header_styles')
@endsection

@section('content')
    @if (isset($property))
        <h2>@lang('headers.update_property') {{ $property->code }}</h2>
        <form action="{{ route('property.update', $property) }}" method="POST">
            @method('PUT')
    @else
        <h2>@lang('headers.create_property')</h2>
        <form action="{{ route('property.store') }}" method="POST">
    @endif
        <div class="mb-3">
            <label for="name_ru" class="form-label">@lang('tables.name_ru')</label>
            @error('name_ru')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name_ru" name="name_ru" @isset($property) value="{{ $property->name_ru }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="name_en" class="form-label">@lang('tables.name_en')</label>
            @error('name_en')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name_en" name="name_en" @isset($property) value="{{ $property->name_en }}" @endisset>
        </div>
        @csrf
        
        @if (isset($property))
            <button type="submit" class="btn btn-primary">@lang('btn.update')</button>
        @else
            <button type="submit" class="btn btn-primary">@lang('btn.create')</button>
        @endif
        <a class="btn btn-success" href="{{ route('property.index') }}">@lang('btn.return_to_properties')</a>
    </form>
@endsection