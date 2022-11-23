<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;

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
//Page Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/favorites', [App\Http\Controllers\PageController::class, 'favorites'])->name('favorites');

//Cart Routes
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/remove/{id}', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

//Product Routes
Route::post('/favorites/{id}', [ProductController::class, 'addToFav'])->name('addToFav');
Route::get('/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/create', [ProductController::class, 'store'])->name('products.store');

// Json routes
Route::get('/products', [PageController::class, 'jsonhome'])->name('jsonhome');
Route::get('/productsfav', [PageController::class, 'jsonfav'])->name('jsonfav');