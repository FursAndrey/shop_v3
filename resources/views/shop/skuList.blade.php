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
                    <h4><a href="{{ route('skuPage', $sku->id) }}" class="mt-2 btn btn-info">{{ $sku->product->name }}</a></h4>
                    <p>{{ $sku->price }} {{ $sku->cur_code }}</p>
                    @if ($sku->count > 0)
                        <form action="{{ route('addToBasket', $sku) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success" title="@lang('btn.add_to_basket')">
                                @lang('btn.add_to_basket')
                            </button>
                        </form>
                    @else
                        <p class="text-danger border border-danger p-1 d-inline">@lang('btn.not_available_for_order')</p>
                    @endif
                </div>
            @endforeach
        </div>
      </div>
    {{ $skus->links() }}
@endsection