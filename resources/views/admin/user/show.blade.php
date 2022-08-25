@extends('../admin/main')

@section('title') @lang('headers.user') @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>@lang('headers.user') {{ $user->name }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('user.index') }}">@lang('btn.return_to_users')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.name')</th>
            <th>@lang('tables.value')</th>
        </tr>
        <tr>
            <td>@lang('tables.login')</td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td>@lang('tables.email')</td>
            <td>{{ $user->email }}</td>
        </tr>
    </table>
@endsection