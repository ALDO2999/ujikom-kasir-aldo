<?php

use App\Export\PenjualanExport;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Pembelian\PembelianController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');  


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});



    Route::get('/admin/dashboard', [DashboardController::class, 'dashboardAdmin'])->name('admin.dashboard');


    // Route::get('/product/list', [ProductController::class, 'list']);
    Route::get('/product/index', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::put('/product/update-stock/{id}', [ProductController::class, 'updateStock'])->name('product.updateStock');
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');


    Route::get('/pembelian', [PembelianController::class, 'index'])->name('admin.pembelian.index');


    Route::get('/export-penjualan', function () {
        return Excel::download(new PenjualanExport, 'laporan-penjualan.xlsx');
    })->name('penjualan.export');

    // USER
    Route::get('/user', [AuthController::class, 'index'])->name('user.index');
    Route::get('/user/create', [AuthController::class, 'create'])->name('user.create');
    Route::post('/user/store', [AuthController::class, 'store'])->name('user.store');
    
    Route::get('/user/edit/{id}', [AuthController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [AuthController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{id}', [AuthController::class, 'destroy'])->name('user.delete');





    Route::get('/petugas/dashboard', [DashboardController::class, 'dashboardPetugas'])->name('petugas.dashboard');

    Route::get('petugas/product/index', [ProductController::class, 'index'])->name('petugas.product.index');

    Route::get('/pembelian/petugas', [PembelianController::class, 'index'])->name('petugas.pembelian.index');

    Route::get('/pembelian/petugas/formInput', [PembelianController::class, 'formInput'])->name('petugas.pembelian.formInput');
    Route::get('/pembelian/petugas/create', [PembelianController::class, 'create'])->name('petugas.pembelian.create');
    Route::post('/pembelian/petugas/store', [PembelianController::class, 'store'])->name('petugas.pembelian.store');


    Route::get('/member/verification', [MemberController::class, 'showVerificationForm'])->name('member.verification');
    Route::post('/member/verification', [MemberController::class, 'verifyMember'])->name('member.verify');
    Route::get('/receipt/{order}', [PembelianController::class, 'receipt'])->name('receipt.show');



    Route::get('/print/{order}', [PembelianController::class, 'print'])->name('pembelian.print');








