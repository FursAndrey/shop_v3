<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use Illuminate\Http\Request;
use App\MyServices\CurrencyConversion;

class PageController extends Controller
{
    public function skuList()
    {
        $currencies = CurrencyConversion::getCurrencies();
        $skus = Sku::with(['product', 'currency'])->paginate(8);
        return view('shop.skuList', compact('skus', 'currencies'));
    }

    public function skuPage(int $sku_id)
    {
        $currencies = CurrencyConversion::getCurrencies();
        $sku = Sku::with(['product', 'currency'])->find($sku_id);
        return view('shop.skuPage', compact('sku', 'currencies'));
    }

    public function setCurrency(string $currency_code)
    {
        session(['currency' => $currency_code]);
        return redirect()->back();
    }
}
