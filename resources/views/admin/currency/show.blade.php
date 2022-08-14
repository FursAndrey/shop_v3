@extends('../admin/main')

@section('title') Валюта @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>Валюта {{ $currency->code }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('currency.index') }}">К списку валют</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>Название</th>
            <th>Значение</th>
        </tr>
        <tr>
            <td>Код</td>
            <td>{{ $currency->code }}</td>
        </tr>
        <tr>
            <td>Курс</td>
            <td>{{ $currency->rate }}</td>
        </tr>
    </table>
@endsection