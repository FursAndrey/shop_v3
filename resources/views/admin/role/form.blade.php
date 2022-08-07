@extends('../admin/main')

@section('title') Создние/Редактирование роли @endsection

@section('header_styles')
@endsection

@section('content')
    @if (isset($role))
        <h2>Редактирование роли {{ $role->code }}</h2>
        <form action="{{ route('role.update', $role) }}" method="POST">
            @method('PUT')
    @else
        <h2>Создние роли</h2>
        <form action="{{ route('role.store') }}" method="POST">
    @endif
        <div class="mb-3">
            <label for="name_ru" class="form-label">Название роли (ru)</label>
            @error('name_ru')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name_ru" name="name_ru" @isset($role) value="{{ $role->name_ru }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="name_en" class="form-label">Название роли (en)</label>
            @error('name_en')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name_en" name="name_en" @isset($role) value="{{ $role->name_en }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="description_ru" class="form-label">Описание роли (ru)</label>
            @error('description_ru')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <textarea class="form-control" id="description_ru" name="description_ru" rows="3">@isset($role) {{ $role->description_ru }} @endisset</textarea>
        </div>
        <div class="mb-3">
            <label for="description_en" class="form-label">Описание роли (en)</label>
            @error('description_en')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <textarea class="form-control" id="description_en" name="description_en" rows="3">@isset($role) {{ $role->description_en }} @endisset</textarea>
        </div>
        @csrf
        
        @if (isset($role))
            <button type="submit" class="btn btn-primary">Редактировать</button>
        @else
            <button type="submit" class="btn btn-primary">Создать</button>
        @endif
        <a class="btn btn-success" href="{{ route('role.index') }}">К списку ролей</a>
    </form>
@endsection