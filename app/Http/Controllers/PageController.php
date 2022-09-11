<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subscribtion;
use Illuminate\Http\Request;
use App\MyServices\CurrencyConversion;
use Illuminate\Support\Facades\App;
use App\Http\Requests\SubscribtionRequest;

class PageController extends Controller
{
    public function skuList(Request $request, Category $category = null)
    {
        $price_filter = $request->price_filter;
        $categories = Category::get();
        $currencies = CurrencyConversion::getCurrencies();
        
        $skusQuery = Sku::with(['product', 'currency', 'product.category', 'property_options', 'property_options.property']);
        if (!is_null($category)) {
            //костыль, но идеи лучше пока нет
            $productsThisCategory = Product::select('id')->where('category_id', '=', $category->id)->get()->toArray();
            $prodArr = [];
            foreach ($productsThisCategory as $product) {
                $prodArr[] = $product['id'];
            }
            
            $skusQuery->whereIn('product_id', $prodArr);
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
    
    public function productList(Request $request, Category $category = null)
    {
        $price_filter = $request->price_filter;
        $categories = Category::get();
        $currencies = CurrencyConversion::getCurrencies();

        $productsQuery = Product::with(['skus', 'skus.currency', 'category', 'skus.property_options', 'skus.property_options.property']);
        if (!is_null($category)) {
            $productsQuery->where('category_id', '=', $category->id);
        }
        
        if (!is_null($price_filter) && preg_match('/^[0-9]+\;[0-9]+$/', $price_filter)) {
            $price_filter_ar = explode(';', $price_filter);
            if ($price_filter_ar[0] <= $price_filter_ar[1]) {
                $skus = Sku::select('id')->whereBetween('price', [$price_filter_ar[0], $price_filter_ar[1]])->get();
            }
            $skuArr = [];
            foreach ($skus as $sku) {
                $skuArr[] = $sku['id'];
            }
            
            $productsQuery->join('skus', 'skus.product_id', '=', 'products.id')->whereIn('skus.id', $skuArr)->select('products.*')->distinct();
        }
        $products = $productsQuery->paginate(8);
        
        return view('shop.productList', compact('products', 'currencies', 'categories', 'category'));
    }

    public function productPage(int $product_id)
    {
        $categories = Category::get();
        $currencies = CurrencyConversion::getCurrencies();
        $product = Product::where('id', '=', $product_id)->get();

        //костыль
        foreach ($product as $tmp) {}
        $product = $tmp;

        $skus = Sku::where('product_id', '=', $product_id)->get();

        return view('shop.productPage', compact('skus', 'currencies', 'categories', 'product'));
    }

    public function subscribtion(SubscribtionRequest $request, int $sku_id)
    {
        Subscribtion::create(
            [
                'email' => $request->email, 
                'sku_id' => $sku_id,
            ]
        );

        return redirect()->route('skuListPage')->with('success', __('flushes.subscribtion'));;
    }
}
