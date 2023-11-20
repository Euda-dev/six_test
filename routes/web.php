<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [StoreController::class, 'home'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/order_success', function () {
    return view('order.order_success');
})->name('order_success');

Route::get('/list_products', [ProductController::class, 'list_products'])->name('list_products')->middleware('auth');

Route::post('/filter_products', [ProductController::class, 'filter_products'])->name('filter_products')->middleware('auth');

Route::get('/list_orders', [OrderController::class, 'list_orders'])->name('list_orders')->middleware('auth');

Route::post('/filter_orders', [OrderController::class, 'filter_orders'])->name('filter_orders')->middleware('auth');

Route::get('/complete_order/{id}', [OrderController::class, 'complete_order'])->name('complete_order')->middleware('auth');

Route::get('/add_products', [ProductController::class, 'add_products_get'])->name('add_products_get')->middleware('auth');

Route::get('/page_product/{id}', [StoreController::class, 'page_product'])->name('page_product');

Route::post('/add_products', [ProductController::class, 'add_products_post'])->name('add_products_post')->middleware('auth');

Route::get('/edit_products/{id}', [ProductController::class, 'edit_products_get'])->name('edit_products_get')->middleware('auth');

Route::post('/edit_products/{id}', [ProductController::class, 'edit_products_post'])->name('edit_products_post')->middleware('auth');

Route::get('/disabled_product/{id}', [ProductController::class, 'disabled_product'])->name('disabled_product')->middleware('auth');

Route::get('/active_product/{id}', [ProductController::class, 'active_product'])->name('active_product')->middleware('auth');

Route::get('/checkout/{quantity}/{id}', [StoreController::class, 'checkout'])->name('checkout');

Route::post('/checkout/{quantity}/{id}', [StoreController::class, 'checkout_post'])->name('checkout_post');


Route::get('/list_users', [UserController::class, 'list_users'])->name('list_users')->middleware('auth');

Route::post('/filter_users', [UserController::class, 'filter_users'])->name('filter_users')->middleware('auth');

Route::get('/add_users', [UserController::class, 'add_users_get'])->name('add_users_get')->middleware('auth');

Route::post('/add_users', [UserController::class, 'add_users_post'])->name('add_users_post')->middleware('auth');

Route::get('/edit_users/{id}', [UserController::class, 'edit_users_get'])->name('edit_users_get')->middleware('auth');

Route::post('/edit_users/{id}', [UserController::class, 'edit_users_post'])->name('edit_users_post')->middleware('auth');

Route::get('/disabled_user/{id}', [UserController::class, 'disabled_user'])->name('disabled_user')->middleware('auth');

Route::get('/active_user/{id}', [UserController::class, 'active_user'])->name('active_user')->middleware('auth');
