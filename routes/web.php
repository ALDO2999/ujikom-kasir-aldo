<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');  


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});



    // Route::get('/product/list', [ProductController::class, 'list']);
    Route::get('/product/index', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::put('/product/update-stock/{id}', [ProductController::class, 'updateStock'])->name('product.updateStock');
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');


    // USER
    Route::get('/user', [AuthController::class, 'index'])->name('user.index');
    Route::get('/user/create', [AuthController::class, 'create'])->name('user.create');
    Route::post('/user/store', [AuthController::class, 'store'])->name('user.store');
    
    Route::get('/user/edit/{id}', [AuthController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [AuthController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{id}', [AuthController::class, 'destroy'])->name('user.delete');





Route::get('/admin/dashboard', [DashboardController::class, 'dashboardAdmin'])->name('admin.dashboard');

