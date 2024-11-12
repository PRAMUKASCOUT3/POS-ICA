<?php

use App\Http\Controllers\CashierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::middleware(['auth', 'admin'])->group(function () {
   
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::get('/admin/pengguna', [UserController::class,'index'])->name('pengguna.index');
    Route::get('/admin/pengguna/{id}/edit',[UserController::class,'edit'])->name('pengguna.edit');
    Route::get('/admin/pengguna/Laporan',[UserController::class,'report'])->name('pengguna.laporan');
    Route::get('/admin/pengguna/print',[UserController::class,'generatePDF'])->name('pengguna.print');

    Route::get('/admin/supplier', [SupplierController::class,'index'])->name('supplier.index');
    Route::get('/admin/supplier/{id}/edit',[SupplierController::class, 'edit'])->name('supplier.edit');
    
    Route::get('/admin/kategori',[CategoryController::class,'index'])->name('category.index');
    Route::get('/admin/kategori/{id}/edit',[CategoryController::class, 'edit'])->name('category.edit');
    
    Route::get('/admin/produk',[ProductController::class,'index'])->name('product.index');
Route::get('/admin/produk/tambah',[ProductController::class,'create'])->name('product.create');
Route::get('/admin/produk/{id}/edit',[ProductController::class, 'edit'])->name('product.edit');
Route::get('/admin/produk/laporan',[ProductController::class,'report'])->name('product.report');
Route::get('/admin/produk/print',[ProductController::class,'generatePDF'])->name('product.print');



});
Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/',[UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/pengeluaran',[ExpenditureController::class,'index'])->name('expenditures.index');
    Route::get('/admin/pengeluaran/{id}/edit',[ExpenditureController::class,'edit'])->name('expenditures.edit');
    
    Route::get('/admin/kasir',[CashierController::class,'index'])->name('cashier.index');
    Route::get('/admin/kasir/print/',[CashierController::class,'print'])->name('cashier.print');
    Route::get('/admin/kasir/riwayat',[CashierController::class,'history'])->name('cashier.riwayat');
    Route::get('/admin/kasir/laporan',[CashierController::class,'report'])->name('cashier.report');
    Route::get('/admin/kasir/print-pdf',[CashierController::class,'generatePDF'])->name('cashier.pdf');
        
});