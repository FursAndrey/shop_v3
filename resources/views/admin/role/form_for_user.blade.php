@extends('../admin/main')

@section('title') Добавление роли @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>Добавление роли для {{ $user->name }}</h2>
    <form action="{{ route('role.add_role', $user) }}" method="POST">
        <div class="mb-3">
            <label for="role_id" class="form-label">Роль</label>
            <select name="role_id" class="form-select" id="role_id">
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name_ru }}/{{ $role->name_en }}</option>
                @endforeach
            </select>
            @error('role_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        @csrf
        
        <button type="submit" class="btn btn-primary">Добавить роль</button>
        <a class="btn btn-success" href="{{ route('user.index') }}">К списку пользователей</a>
    </form>
@endsection