@extends('../admin/main')

@section('title') @lang('headers.create_update_option') @endsection

@section('header_styles')
@endsection

@section('content')
    @if (isset($propertyOption))
        <h2>@lang('headers.update_option') {{ $propertyOption->name }}</h2>
        <form action="{{ route('property_option.update', $propertyOption) }}" method="POST">
            @method('PUT')
    @else
        <h2>@lang('headers.create_option')</h2>
        <form action="{{ route('property_option.store') }}" method="POST">
    @endif
        <div class="mb-3">
            <label for="name_ru" class="form-label">@lang('tables.name_ru')</label>
            @error('name_ru')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name_ru" name="name_ru" @isset($propertyOption) value="{{ $propertyOption->name_ru }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="name_en" class="form-label">@lang('tables.name_en')</label>
            @error('name_en')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name_en" name="name_en" @isset($propertyOption) value="{{ $propertyOption->name_en }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="property_id" class="form-label">@lang('tables.name')</label>
            <select name="property_id" class="form-select" id="property_id">
                @foreach ($properties as $property)
                <option value="{{ $property->id }}" {{ (isset($propertyOption) && $propertyOption->property_id == $property->id)? 'selected': '' }}>{{ $property->name }}</option>
                @endforeach
            </select>
            @error('property_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        @csrf
        
        @if (isset($propertyOption))
            <button type="submit" class="btn btn-primary">@lang('btn.update')</button>
        @else
            <button type="submit" class="btn btn-primary">@lang('btn.create')</button>
        @endif
        <a class="btn btn-success" href="{{ route('property_option.index') }}">@lang('btn.return_to_options')</a>
    </form>
@endsection