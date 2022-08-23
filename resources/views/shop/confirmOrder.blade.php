@extends('../shop/main')

@section('title') Подтверждение заказа @endsection

@section('content')
    <h2 class="text-center">Подтверждение заказа</h2>
    <div class="container">
        <form action="{{ route('confirmOrder') }}" method="post">
            <div class="mb-4">
                <div>
                    <label for="user_name" class="form-label col-12">@lang('tables.login')<span style="color:red">*</span></label>
                    @error('user_name')
                        <div class="alert alert-danger p-3">{{ $message }}</div>
                    @enderror
                    <input type="text" id="user_name" name="user_name" class="form-control col-12" value="{{ old('user_name', null) }}">
                </div>
            </div>
            @guest
                <div class="mb-4">
                    <div>
                        <label for="user_email" class="form-label col-12">@lang('tables.email')<span style="color:red">*</span></label>
                        @error('user_email')
                            <div class="alert alert-danger p-3">{{ $message }}</div>
                        @enderror
                        <input type="text" id="user_email" name="user_email" class="form-control col-12" value="{{ old('user_email', null) }}">
                    </div>
                </div>
            @endguest
            <div class="mb-4">
                @error('description')
                    <div class="alert alert-danger p-3">{{ $message }}</div>
                @enderror
                <div>
                    <label for="description" class="form-label col-12">@lang('tables.description')</label>
                    @error('description')
                        <div class="alert alert-danger p-3">{{ $message }}</div>
                    @enderror
                    <textarea name="description" id="description" cols="30" rows="5" class="form-control col-12" style="resize: none;">{{ old('user_email', '') }}</textarea>
                </div>
            </div>
            @csrf
            <button type="submit" class="btn btn-success">@lang('btn.confirm_order')</button>
            <a class="btn btn-warning" href="{{ route('showBasket') }}">@lang('btn.basket')</a>
            <a class="btn btn-warning" href="{{ route('skuListPage') }}">@lang('btn.home')</a>
        </form>
    </div>
@endsection