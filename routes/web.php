<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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
});

// Admin Route
Route::middleware(['auth', 'user-role:administrator'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/users-management', [AdminController::class, 'users_view'])->name('admin.users');
    Route::post('/users/delete/{id}', [AdminController::class, 'delete_user'])->name('user.nonactive');
});
