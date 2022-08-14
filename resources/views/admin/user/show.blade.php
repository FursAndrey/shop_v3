@extends('../admin/main')

@section('title') Пользователь @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>Пользователь {{ $user->name }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('user.index') }}">К списку пользователей</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>Название</th>
            <th>Значение</th>
        </tr>
        <tr>
            <td>Логин</td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td>Почта</td>
            <td>{{ $user->email }}</td>
        </tr>
    </table>
@endsection