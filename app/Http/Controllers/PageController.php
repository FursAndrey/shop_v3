<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use App\Models\Category;
use Illuminate\Http\Request;
use App\MyServices\CurrencyConversion;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{
    public function skuList(Request $request, Category $category = null)
    {
        $price_filter = $request->price_filter;
        $categories = Category::get();
        $currencies = CurrencyConversion::getCurrencies();
        
        $skusQuery = Sku::with(['product', 'currency', 'product.category']);
        if (!is_null($category)) {
            $skusQuery->join('products', 'products.id', '=', 'skus.product_id');
            $skusQuery->where('category_id', '=', $category->id);
        }
        if (!is_null($price_filter) && preg_match('/^[0-9]+\;[0-9]+$/', $price_filter)) {
            $price_filter_ar = explode(';', $price_filter);
            if ($price_filter_ar[0] <= $price_filter_ar[1]) {
                $skusQuery->where('price', '>=', $price_filter_ar[0]);
                $skusQuery->where('price', '<=', $price_filter_ar[1]);
            }
        }
        $skus = $skusQuery->paginate(8);
        
        return view('shop.skuList', compact('skus', 'currencies', 'categories', 'category'));
    }

    public function skuPage(int $sku_id)
    {
        $categories = Category::get();
        $currencies = CurrencyConversion::getCurrencies();
        $sku = Sku::with(['product', 'currency'])->find($sku_id);
        return view('shop.skuPage', compact('sku', 'currencies', 'categories'));
    }

    public function setCurrency(string $currency_code)
    {
        session(['currency' => $currency_code]);
        return redirect()->back();
    }
    
    public function setLocale($locale)
    {
        session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect()->back();
    }
    
}
