<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyOptionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SkuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ResetController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('changeLocale')->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('skuListPage');
    })->middleware(['userIsAdmin'])->name('dashboard');

    
    Route::prefix('admin')->middleware('userIsSeller')->group(function () {
        Route::resource('sku', SkuController::class);
    });
    Route::prefix('admin')->middleware('userIsAdmin')->group(function () {
        Route::resource('category', CategoriesController::class);
        Route::resource('currency', CurrencyController::class);
        Route::resource('product', ProductController::class);
        Route::resource('property', PropertyController::class);
        Route::resource('property_option', PropertyOptionController::class);
        Route::resource('role', RoleController::class);
        Route::get('property_option/create_for_property/{property}', [PropertyOptionController::class, 'create_for_property'])->name('property_option.create_for_property')->where('property', '[0-9]+');
        Route::get('product/create_for_category/{category}', [ProductController::class, 'create_for_category'])->name('product.create_for_category')->where('category', '[0-9]+');
        Route::get('sku/create_for_product/{product}', [SkuController::class, 'create_for_product'])->name('sku.create_for_product')->where('product', '[0-9]+');
        Route::get('user/index', [UserController::class, 'index'])->name('user.index');
        Route::get('user/show/{user}', [UserController::class, 'show'])->name('user.show')->where('user', '[0-9]+');
        Route::get('role/create_for_user/{user}', [RoleController::class, 'create_for_user'])->name('role.create_for_user')->where('user', '[0-9]+');
        Route::post('role/add_role/{user}', [RoleController::class, 'add_role'])->name('role.add_role')->where('user', '[0-9]+');
        Route::get('orders', [OrderController::class, 'index'])->name('order.index');
        Route::get('orders/show/{order}', [OrderController::class, 'show'])->name('order.show')->where('order', '[0-9]+');
        Route::delete('orders/{order}', [OrderController::class, 'cencel'])->name('order.cencel')->where('order', '[0-9]+');
        Route::post('orders/{order}', [OrderController::class, 'success'])->name('order.success')->where('order', '[0-9]+');
    });
    Route::get('/{category?}', [PageController::class, 'skuList'])->name('skuListPage')->where('category', '[0-9]+');
    Route::post('/{category?}', [PageController::class, 'skuList'])->name('skuListForm')->where('category', '[0-9]+');
    Route::get('/sku/{sku_id}', [PageController::class, 'skuPage'])->name('skuPage')->where('sku_id', '[0-9]+');

    Route::get('/reset/project', [ResetController::class, 'resetProject'])->name('resetProject');
    
    Route::get('/productList/{category?}', [PageController::class, 'productList'])->name('productListPage')->where('category', '[0-9]+');
    Route::post('/productList/{category?}', [PageController::class, 'productList'])->name('productListForm')->where('category', '[0-9]+');
    Route::get('/product/{product_id}', [PageController::class, 'productPage'])->name('productPage')->where('product_id', '[0-9]+');

    Route::get('/basket', [BasketController::class, 'showBasket'])->name('showBasket');
    Route::post('/basket/add/{sku}', [BasketController::class, 'addToBasket'])->name('addToBasket')->where('sku', '[0-9]+');
    Route::post('/basket/remove/{sku}', [BasketController::class, 'removeFromBasket'])->name('removeFromBasket')->where('sku', '[0-9]+');
    Route::delete('/basket/remuveThisSku/{sku}', [BasketController::class, 'remuveThisSkuFromBasket'])->name('remuveThisSkuFromBasket')->where('sku', '[0-9]+');
    Route::delete('/basket/clear', [BasketController::class, 'clearBasket'])->name('clearBasket');
    Route::get('/basket/confirm', [BasketController::class, 'confirmOrderForm'])->name('confirmOrderForm');
    Route::post('/basket/confirm', [BasketController::class, 'confirmOrder'])->name('confirmOrder');
    Route::get('/setCur/{currencyCode}', [PageController::class, 'setCurrency'])->name('setCurrency')->where('currencyCode', '[A-Z]{3}');
    Route::get('/setLocale/{locale}', [PageController::class, 'setLocale'])->name('setLocale')->where('locale', '[A-Za-z]{2}');

    Route::get('/basket/checkShow/{order}', [BasketController::class, 'checkShow'])->name('checkShow');
    Route::get('/basket/checkLoad/{order}', [BasketController::class, 'checkLoad'])->name('checkLoad');

    require __DIR__.'/auth.php';
});
