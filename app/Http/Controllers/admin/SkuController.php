<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkuRequest;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Sku;

use Illuminate\Support\Str;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skus = Sku::with(['product','currency'])->paginate(15);
        return view('admin.sku.index', compact('skus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        $currencies = Currency::get();
        return view(
            'admin.sku.form', 
            [
                'products' => $products,
                'currencies' => $currencies,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SkuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkuRequest $request)
    {
        $sku = Sku::create($request->all());
        if ($request->has('property_option_id')) {
            $sku->property_options()->sync($request->property_option_id);
        }
        return redirect()->route('sku.index')->with('success', __('flushes.sku_added', ['sku' => $sku->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function show(Sku $sku)
    {
        return view('admin.sku.show', compact('sku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function edit(Sku $sku)
    {
        $products = Product::get();
        $currencies = Currency::get();
        return view(
            'admin.sku.form', 
            [
                'products' => $products,
                'currencies' => $currencies,
                'sku' => $sku,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SkuRequest  $request
     * @param  \App\Models\Sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function update(SkuRequest $request, Sku $sku)
    {
        $sku->update($request->all());
        $sku->property_options()->sync($request->property_option_id);
        return redirect()->route('sku.index')->with('warning', __('flushes.sku_updated', ['sku' => $sku->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sku $sku)
    {
        $sku->delete();
        return redirect()->route('sku.index')->with('danger', __('flushes.sku_deleted', ['sku' => $sku->id]));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function create_for_product(Product $product)
    {
        $currencies = Currency::get();
        return view('admin.sku.form_for_prod', compact(['product', 'currencies']));
    }
}
