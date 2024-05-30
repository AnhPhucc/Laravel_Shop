<?php

use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;

// Route::get('/', function(){
//     $products = Product::all();
//     return view('welcome', compact('products'));
// })->name('home');


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/user', [HomeController::class, 'user'])->name('user');
Route::get('/products', [HomeController::class, 'product'])->name('products');
Route::get('/products/{id}/detail', [ProductController::class, 'show'])->name('products.Detail');

Route::resource('/categories',CategoryController::class);
// Route::resource('/products',ProductController::class);
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('addtocart');
Route::post('/delete-cart/{id}', [CartController::class, 'delete'])->name('deletecart');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::post('/delete-cart/{id}', [CartController::class, 'deleteCart'])->name('delete-cart');

Route::post('/checkout', [CheckoutController::class,'check'])->name('checkout');








Auth::routes();


