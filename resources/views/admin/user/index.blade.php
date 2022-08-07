@extends('../admin/main')

@section('title') Пользователи @endsection

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
    <h2>Пользователи</h2>
    <table class="table table-striped table-hover">
        <tr>
            <th>Логин</th>
            <th>Почта</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td><a href="{{ route('user.show', $user) }}" class="btn btn-info">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
            </tr>
        @endforeach
    </table>
    {{ $users->links() }}
@endsection