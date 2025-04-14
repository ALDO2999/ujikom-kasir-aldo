<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/dashboard', [DashboardController::class, 'dashboardAdmin'])->name('admin.dashboard');
