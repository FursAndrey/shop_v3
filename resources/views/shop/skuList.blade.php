@extends('../shop/main')

@section('title') Главная страница @endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p class="text-center">{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('warning'))
        <div class="alert alert-warning">
            <p class="text-center">{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('danger'))
        <div class="alert alert-danger">
            <p class="text-center">{{ $message }}</p>
        </div>
    @endif
    <h2 class="text-center">Каталог товаров</h2>
    <div class="container">
        <div class="row">
            @foreach ($skus as $sku)
                <div class="col-3 mb-5 mt-3">
                    <a href="{{ route('skuPage', $sku->id) }}"><img src="{{ $sku->product->img_for_view }}" alt="изображение не добавлено" style="max-width: 200px;"></a>
                    <h4><a href="{{ route('skuPage', $sku->id) }}" class="mt-2 btn btn-dark">{{ $sku->product->name_ru }}/{{ $sku->product->name_en }}</a></h4>
                    <p>{{ $sku->price }} {{ $sku->currency->code }}</p>
                    @if ($sku->count > 0)
                        <form action="{{ route('addToBasket', $sku) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success" title="Добавить в корзину">
                                Добавить в корзину
                            </button>
                        </form>
                    @else
                        <p class="text-danger">Не доступен для заказа</p>
                    @endif
                </div>
            @endforeach
        </div>
      </div>
    {{ $skus->links() }}
@endsection