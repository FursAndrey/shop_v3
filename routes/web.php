<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyOptionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SkuController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('category', CategoriesController::class);
Route::resource('currency', CurrencyController::class);
Route::resource('product', ProductController::class);
Route::resource('property', PropertyController::class);
Route::resource('property_option', PropertyOptionController::class);
Route::resource('sku', SkuController::class);
Route::resource('role', RoleController::class);
Route::get('property_option/create_for_property/{property}', [PropertyOptionController::class, 'create_for_property'])->name('property_option.create_for_property');
Route::get('product/create_for_category/{category}', [ProductController::class, 'create_for_category'])->name('product.create_for_category');
Route::get('sku/create_for_product/{product}', [SkuController::class, 'create_for_product'])->name('sku.create_for_product');
Route::get('user/index', [UserController::class, 'index'])->name('user.index');
Route::get('user/show/{user}', [UserController::class, 'show'])->name('user.show');

require __DIR__.'/auth.php';
