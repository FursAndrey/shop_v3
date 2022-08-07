@extends('../admin/main')

@section('title') Создние/Редактирование валюты @endsection

@section('header_styles')
@endsection

@section('content')
    @if (isset($currency))
        <h2>Редактирование валюты {{ $currency->code }}</h2>
        <form action="{{ route('currency.update', $currency) }}" method="POST">
            @method('PUT')
    @else
        <h2>Создние валюты</h2>
        <form action="{{ route('currency.store') }}" method="POST">
    @endif
        <div class="mb-3">
            <label for="code" class="form-label">Код</label>
            @error('code')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="code" name="code" @isset($currency) value="{{ $currency->code }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="rate" class="form-label">Курс</label>
            @error('rate')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="rate" name="rate" @isset($currency) value="{{ $currency->rate }}" @endisset>
        </div>
        @csrf
        
        @if (isset($currency))
            <button type="submit" class="btn btn-primary">Редактировать</button>
        @else
            <button type="submit" class="btn btn-primary">Создать</button>
        @endif
        <a class="btn btn-success" href="{{ route('currency.index') }}">К списку валют</a>
    </form>
@endsection