<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin/dashboard', [DashboardController::class, 'dashboardAdmin'])->name('admin.dashboard');






// Route::get('/admin/dashboard', [DashboardController::class, 'dashboardAdmin'])->name('admin.dashboard');