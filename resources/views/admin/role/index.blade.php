@extends('../admin/main')

@section('title') Роли @endsection

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
    <h2>Роли</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('role.create') }}">Добавить роль</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>Название RU</th>
            <th>Название EN</th>
            <th>Описание RU</th>
            <th>Описание EN</th>
            <th></th>
        </tr>
        @foreach ($roles as $role)
            <tr>
                <td><a href="{{ route('role.show', $role) }}" class="btn btn-info">{{ $role->name_ru }}</a></td>
                <td><a href="{{ route('role.show', $role) }}" class="btn btn-info">{{ $role->name_en }}</a></td>
                <td>{{ $role->description_ru }}</td>
                <td>{{ $role->description_en }}</td>
                <td>
                    <a href="{{ route('role.edit', $role) }}" class="btn btn-warning d-inline-block">Редактировать</a>
                    <form action="{{ route('role.destroy', $role) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $roles->links() }}
@endsection