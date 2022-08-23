@extends('../admin/main')

@section('title') Создние/Редактирование категории @endsection

@section('header_styles')
@endsection

@section('content')
    @if (isset($category))
        <h2>Редактирование категории {{ $category->name_ru }}/{{ $category->name_en }}</h2>
        <form action="{{ route('category.update', $category) }}" method="POST">
            @method('PUT')
    @else
        <h2>Создние категории</h2>
        <form action="{{ route('category.store') }}" method="POST">
    @endif
        <div class="mb-3">
            <label for="name_ru" class="form-label">@lang('tables.name_ru')</label>
            @error('name_ru')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name_ru" name="name_ru" @isset($category) value="{{ $category->name_ru }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="name_en" class="form-label">@lang('tables.name_en')</label>
            @error('name_en')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name_en" name="name_en" @isset($category) value="{{ $category->name_en }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="code" class="form-label">@lang('tables.code')</label>
            @error('code')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="code" name="code" @isset($category) value="{{ $category->code }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="description_ru" class="form-label">@lang('tables.description_ru')</label>
            @error('description_ru')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <textarea class="form-control" id="description_ru" name="description_ru" rows="3">@isset($category) {{ $category->description_ru }} @endisset</textarea>
        </div>
        <div class="mb-3">
            <label for="description_en" class="form-label">@lang('tables.description_en')</label>
            @error('description_en')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <textarea class="form-control" id="description_en" name="description_en" rows="3">@isset($category) {{ $category->description_en }} @endisset</textarea>
        </div>
        @csrf
        
        @if (isset($category))
            <button type="submit" class="btn btn-primary">@lang('btn.update')</button>
        @else
            <button type="submit" class="btn btn-primary">@lang('btn.create')</button>
        @endif
        <a class="btn btn-success" href="{{ route('category.index') }}">@lang('btn.return_to_categories')</a>
    </form>
@endsection