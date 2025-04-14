<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/dashboard',[HomeController::class,'index'])->middleware(['auth','admin']);
Route::get('/',[HomeController::class,'home']);
Route::get('view_category',[AdminController::class,'view_category']);
Route::post('add_category',[AdminController::class,'add_category']);
Route::get('delete_category/{id}',[AdminController::class,'delete_category']);
Route::get('edit_category/{id}',[AdminController::class,'edit_category']);
Route::post('update_category/{id}',[AdminController::class,'update_category']);

// 

// Add these routes after your category routes
Route::get('view_product', [AdminController::class, 'view_product']);
Route::get('add_product', [AdminController::class, 'add_product']);
Route::get('delete_product/{id}', [AdminController::class, 'delete_product']);
Route::get('edit_product/{id}', [AdminController::class, 'edit_product']);
Route::post('update_product/{id}', [AdminController::class, 'update_product']);
Route::post('insert_product',[AdminController::class,'insert_product']);

//      Products routes 

// Client routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/category/{category}', [ProductController::class, 'productsByCategory'])->name('products.category');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');
Route::post('/product/purchase/{id}', [ProductController::class, 'purchase'])->middleware('auth')->name('products.purchase');


use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


    // Cart routes 

    // Route::middleware(['auth'])->group(function () {
    //     Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    //     // Route::get('viewCart', [CartController::class, 'viewCart'])->name('cart.view');
    //     Route::post('/cart/remove/{product}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    //     Route::post('/cart/update/{product}', [CartController::class, 'updateCart'])->name('cart.update');
    //     Route::get('viewCart', [CartController::class, 'viewCart']);
    // });
    Route::middleware(['auth'])->group(function () {
        // Cart routes
        Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
        Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
        Route::post('/cart/remove/{product}', [CartController::class, 'removeFromCart'])->name('cart.remove');
        Route::post('/cart/update/{product}', [CartController::class, 'updateCart'])->name('cart.update');
        
        // Checkout routes
        Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
        Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('checkout.process');
        Route::get('/order/confirmation', [CartController::class, 'orderConfirmation'])->name('order.confirmation');

        //Receipt route

        Route::get('/order/receipt/{order}', [CartController::class, 'showReceipt'])->name('order.receipt');
    });

