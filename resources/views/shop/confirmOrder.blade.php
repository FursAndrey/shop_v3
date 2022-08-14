@extends('../shop/main')

@section('title') Подтверждение заказа @endsection

@section('content')
    <h2 class="text-center">Подтверждение заказа</h2>
    <div class="container">
        <form action="{{ route('confirmOrder') }}" method="post">
            <div class="mb-4">
                @error('user_name')
                    <div class="error">{{ $message }}</div>
                @enderror
                <div>
                    <label for="user_name" class="form-label col-12">Имя<span style="color:red">*</span></label>
                    <input type="text" id="user_name" name="user_name" class="form-control col-12">
                </div>
            </div>
            @guest
                <div class="mb-4">
                    @error('user_email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <div>
                        <label for="user_email" class="form-label col-12">Email<span style="color:red">*</span></label>
                        <input type="text" id="user_email" name="user_email" class="form-control col-12">
                    </div>
                </div>
            @endguest
            <div class="mb-4">
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
                <div>
                    <label for="description" class="form-label col-12">Примечание</label>
                    <textarea name="description" id="description" cols="30" rows="5" class="form-control col-12" style="resize: none;"></textarea>
                </div>
            </div>
            @csrf
            <button type="submit" class="btn btn-success">Подтвердить заказ</button>
        </form>
    </div>
@endsection