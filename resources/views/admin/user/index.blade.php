@extends('../admin/main')

@section('title') @lang('headers.users') @endsection

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
    <h2>@lang('headers.users')</h2>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.login')</th>
            <th>@lang('tables.email')</th>
            <th>@lang('tables.roles')</th>
            <th></th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td><a href="{{ route('user.show', $user) }}" class="btn btn-info">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach ($user->roles as $role)
                        {{ $role->name }}<br/>
                    @endforeach
                </td>
                <td><a href="{{ route('role.create_for_user', $user) }}" class="btn btn-primary d-inline-block">@lang('btn.add_role')</a></td>
            </tr>
        @endforeach
    </table>
    {{ $users->links() }}
@endsection