<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use Throwable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['skus'])->paginate(15);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $properties = Property::get();
        return view(
            'admin.product.form', 
            [
                'categories' => $categories,
                'properties' => $properties,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $intoDB = $request->only(['name_ru', 'name_en', 'description_ru', 'description_en', 'category_id']);
        $intoDB['img'] = $request->file('img')->store('uploads', 'public');
        $product = Product::create($intoDB);
        if ($request->has('property_id')) {
            $product->properties()->sync($request->property_id);
        }

        $txt = 'Продукт '.$request->name_ru.'/'.$request->name_en.' добавлен.';
        return redirect()->route('product.index')->with('success', $txt);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        $properties = Property::get();
        return view(
            'admin.product.form', 
            [
                'categories' => $categories,
                'properties' => $properties,
                'product' => $product,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $intoDB = $request->only(['name_ru', 'name_en', 'description_ru', 'description_en', 'category_id']);
        if (!is_null($request->img)) {
            $oldImage = $product->img_for_delete;
            $intoDB['img'] = $request->file('img')->store('uploads', 'public');
        } else {
            $oldImage = NULL;
        }
        
        $product->update($intoDB);
        $product->properties()->sync($request->property_id);
        
        if (!is_null($oldImage) && file_exists($oldImage)) {
            unlink($oldImage);
        }
        $txt = 'Продукт '.$request->name_ru.'/'.$request->name_en.' изменен.';
        return redirect()->route('product.index')->with('warning', $txt);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
        } catch (Throwable $e) {
            if ($e->errorInfo[0] == 23000 && $e->errorInfo[1] == 1451) {
                return redirect()->route('product.index')->withDanger('Не удается удалить продукт '.$product->name_ru.'/'.$product->name_en);
            }
        }
        
        if (file_exists($product->img_for_delete)) {
            unlink($product->img_for_delete);
        }
        return redirect()->route('product.index')->withDanger('Продукт '.$product->name_ru.'/'.$product->name_en.' удален');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function create_for_category(Category $category)
    {
        $categories = Category::get();
        $properties = Property::get();
        return view('admin.product.form_for_cat', compact(['category', 'categories' , 'properties']));
    }
}
