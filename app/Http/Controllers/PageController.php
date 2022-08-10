<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function skuList()
    {
        $skus = Sku::with(['product', 'currency'])->paginate(8);
        return view('shop.skuList', compact('skus'));
    }
}
