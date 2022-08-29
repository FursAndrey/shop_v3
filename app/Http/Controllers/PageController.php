<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use App\Models\Category;
use Illuminate\Http\Request;
use App\MyServices\CurrencyConversion;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{
    public function skuList(Category $category = null)
    {
        $categories = Category::get();
        $currencies = CurrencyConversion::getCurrencies();
        
        $skusQuery = Sku::with(['product', 'currency', 'product.category']);
        if (!is_null($category)) {
            $skusQuery->join('products', 'products.id', '=', 'skus.product_id');
            $skusQuery->where('category_id', '=', $category->id);
        }
        $skus = $skusQuery->paginate(8);
        
        return view('shop.skuList', compact('skus', 'currencies', 'categories'));
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
