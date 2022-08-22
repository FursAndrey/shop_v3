@extends('../admin/main')

@section('title') Валюты @endsection

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
    <h2>Валюты</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('currency.create') }}">@lang('btn.create')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>Код</th>
            <th>Курс</th>
            <th></th>
        </tr>
        @foreach ($currencies as $currency)
            <tr>
                <td><a href="{{ route('currency.show', $currency) }}" class="btn btn-info">{{ $currency->code }}</a></td>
                <td>{{ number_format($currency->rate, 2) }}</td>
                <td>
                    <a href="{{ route('currency.edit', $currency) }}" class="btn btn-warning d-inline-block">@lang('btn.update')</a>
                    <form action="{{ route('currency.destroy', $currency) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">@lang('btn.delete')</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $currencies->links() }}
@endsection