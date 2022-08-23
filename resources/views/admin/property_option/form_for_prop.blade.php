@extends('../admin/main')

@section('title') Создние значения для свойства @endsection

@section('header_styles')
@endsection

@section('content')
        <h2>Создние значения для свойства {{ $property->name_ru.'/'.$property->name_en }}</h2>
        <form action="{{ route('property_option.store') }}" method="POST">
        <div class="mb-3">
            <label for="name_ru" class="form-label">@lang('tables.name_ru')</label>
            @error('name_ru')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name_ru" name="name_ru">
        </div>
        <div class="mb-3">
            <label for="name_en" class="form-label">@lang('tables.name_en')</label>
            @error('name_en')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name_en" name="name_en">
        </div>
        <input type="hidden" name="property_id" value="{{ $property->id }}">
        @csrf
        <button type="submit" class="btn btn-primary">@lang('btn.create')</button>
        <a class="btn btn-success" href="{{ route('property.index') }}">@lang('btn.return_to_options')</a>
    </form>
@endsection