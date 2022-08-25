@extends('../admin/main')

@section('title') @lang('headers.create_update_role') @endsection

@section('header_styles')
@endsection

@section('content')
    @if (isset($role))
        <h2>@lang('headers.update_role') {{ $role->code }}</h2>
        <form action="{{ route('role.update', $role) }}" method="POST">
            @method('PUT')
    @else
        <h2>@lang('headers.create_role')</h2>
        <form action="{{ route('role.store') }}" method="POST">
    @endif
        <div class="mb-3">
            <label for="name_ru" class="form-label">@lang('tables.name_ru')</label>
            @error('name_ru')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name_ru" name="name_ru" @isset($role) value="{{ $role->name_ru }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="name_en" class="form-label">@lang('tables.name_en')</label>
            @error('name_en')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name_en" name="name_en" @isset($role) value="{{ $role->name_en }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="description_ru" class="form-label">@lang('tables.description_ru')</label>
            @error('description_ru')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <textarea class="form-control" id="description_ru" name="description_ru" rows="3">@isset($role) {{ $role->description_ru }} @endisset</textarea>
        </div>
        <div class="mb-3">
            <label for="description_en" class="form-label">@lang('tables.description_en')</label>
            @error('description_en')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <textarea class="form-control" id="description_en" name="description_en" rows="3">@isset($role) {{ $role->description_en }} @endisset</textarea>
        </div>
        @csrf
        
        @if (isset($role))
            <button type="submit" class="btn btn-primary">@lang('btn.update')</button>
        @else
            <button type="submit" class="btn btn-primary">@lang('btn.create')</button>
        @endif
        <a class="btn btn-success" href="{{ route('role.index') }}">@lang('btn.return_to_roles')</a>
    </form>
@endsection