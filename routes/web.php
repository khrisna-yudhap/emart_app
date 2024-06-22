<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [PageController::class, 'index'])->name('index');

Route::get('/sign-in', [AuthController::class, 'index'])->name('login');
Route::post('/loginPost', [AuthController::class, 'login'])->name('login.post');
Route::get('/create-new-account', [UserController::class, 'register'])->name('register');
Route::post('/userPost', [UserController::class, 'create'])->name('user.post');

// User Route
Route::middleware(['auth'])->group(function () {
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    // CART
    Route::get('/my-cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add-to-cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/clear-cart', [CartController::class, 'clear_cart'])->name('cart.destroy');

    // ORDER
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::get('/order-payment/{invoice_id}', [OrderController::class, 'payment'])->name('order.payment');
    Route::get('/order-invoice/{invoice_id}', [OrderController::class, 'invoice'])->name('order.invoice');
});

// Admin Route
Route::middleware(['auth', 'user-role:administrator'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/users-management', [AdminController::class, 'users_view'])->name('admin.users');
    Route::post('/users/delete/{id}', [AdminController::class, 'delete_user'])->name('user.destroy');
    Route::get('/order/view/{id}', [AdminController::class, 'order_detail'])->name('order.view');

    Route::get('/product-category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.destroy');



    Route::get('/products-management', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    // Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.destroy');
});
