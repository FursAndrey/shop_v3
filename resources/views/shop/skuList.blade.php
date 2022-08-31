@extends('../shop/main')

@section('title') @lang('headers.home_page') @endsection

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
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto px-0">
                <div id="sidebar" class="collapse collapse-horizontal show border-end">
                    <form method="GET" action="{{ route('skuListPage', $category) }}" id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start min-vh-100">
                        <p class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><span>@lang('tables.price')</span></p>
                        <div class="me-3">
                            <p>
                                <input type="text" class="js-range-slider" name="price_filter" value=""/>
                            </p>
                            @csrf
                            <button type="submit" class="btn btn-success w-100">@lang('btn.apply')</button>
                            <a href="{{ route('skuListPage') }}" class="btn btn-warning mt-2 w-100">@lang('btn.cancel')</a>
                        </div>
                    </form>
                </div>
            </div>
            <main class="col ps-md-2 pt-2">
                <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse" class="text-success border border-success p-1 text-decoration-none">@lang('btn.filters')</a>
                <div class="page-header pt-3">
                    <h2>@lang('headers.catalog')</h2>
                </div>
                <hr>
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
                {{ $skus->links() }}
            </main>
        </div>
    </div>
@endsection