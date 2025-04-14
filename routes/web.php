<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Product\ProductController;
    use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/admin/dashboard', [DashboardController::class, 'dashboardAdmin'])->name('admin.dashboard');

