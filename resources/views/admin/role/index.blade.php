@extends('../admin/main')

@section('title') @lang('headers.roles') @endsection

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
    <h2>@lang('headers.roles')</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('role.create') }}">@lang('btn.create')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.name_ru')</th>
            <th>@lang('tables.name_en')</th>
            <th>@lang('tables.description_ru')</th>
            <th>@lang('tables.description_en')</th>
            <th></th>
        </tr>
        @foreach ($roles as $role)
            <tr>
                <td><a href="{{ route('role.show', $role) }}" class="btn btn-info">{{ $role->name_ru }}</a></td>
                <td><a href="{{ route('role.show', $role) }}" class="btn btn-info">{{ $role->name_en }}</a></td>
                <td>{{ $role->description_ru }}</td>
                <td>{{ $role->description_en }}</td>
                <td>
                    <a href="{{ route('role.edit', $role) }}" class="btn btn-warning d-inline-block">@lang('btn.update')</a>
                    <form action="{{ route('role.destroy', $role) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">@lang('btn.delete')</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $roles->links() }}
@endsection