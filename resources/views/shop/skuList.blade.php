@extends('../shop/main')

@section('title') Главная страница @endsection

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
    <h2>Каталог товаров</h2>
    <div class="container">
        <div class="row">
            @foreach ($skus as $sku)
                <div class="col-3">
                    <a href="#"><img src="{{ $sku->product->img_for_view }}" alt="изображение не добавлено" style="max-width: 200px;"></a>
                    <h4>{{ $sku->product->name_ru }}/{{ $sku->product->name_en }}</h4>
                    <p>{{ $sku->price }} {{ $sku->currency->code }}</p>
                </div>
            @endforeach
        </div>
      </div>
    {{ $skus->links() }}
@endsection