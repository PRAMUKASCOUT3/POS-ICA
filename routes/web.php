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
   
    Route::get('/home',[UserController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/admin/pengguna', [UserController::class,'index'])->name('pengguna.index');
    Route::get('/admin/pengguna/{id}/edit',[UserController::class,'edit'])->name('pengguna.edit');
    Route::get('/admin/pengguna/Laporan',[UserController::class,'report'])->name('pengguna.laporan');
    Route::get('/admin/pengguna/print',[UserController::class,'generatePDF'])->name('pengguna.print');
    Route::get('/user/pengguna/export/', [UserController::class, 'export'])->name('user.excel');
    Route::delete('/admin/pengguna/delete/{id}',[UserController::class, 'delete'])->name('pengguna.delete');
    Route::get('/admin/profile/{id}',[UserController::class, 'show'])->name('pengguna.show');
    Route::put('/admin/profile/update/{id}',[UserController::class, 'update'])->name('pengguna.update');

    Route::get('/admin/supplier', [SupplierController::class,'index'])->name('supplier.index');
    Route::get('/admin/supplier/{id}/edit',[SupplierController::class, 'edit'])->name('supplier.edit');
    Route::delete('/admin/supplier/delete/{id}',[SupplierController::class, 'delete'])->name('supplier.delete');
    
    Route::get('/admin/kategori',[CategoryController::class,'index'])->name('category.index');
    Route::get('/admin/kategori/{id}/edit',[CategoryController::class, 'edit'])->name('category.edit');
    Route::delete('/admin/kategori/delete/{id}',[CategoryController::class, 'delete'])->name('category.delete');
    
    Route::get('/admin/produk',[ProductController::class,'index'])->name('product.index');
Route::get('/admin/produk/tambah',[ProductController::class,'create'])->name('product.create');
Route::get('/admin/produk/{id}/edit',[ProductController::class, 'edit'])->name('product.edit');
Route::get('/admin/produk/laporan',[ProductController::class,'report'])->name('product.report');
Route::get('/admin/produk/print',[ProductController::class,'generatePDF'])->name('product.print');
Route::get('/admin/produk/export/', [ProductController::class, 'export'])->name('product.excel');
Route::delete('/admin/produk/delete/{id}', [ProductController::class,'delete'])->name('product.delete');






});
Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/',[UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/pengeluaran',[ExpenditureController::class,'index'])->name('expenditures.index');
    Route::get('/admin/pengeluaran/{id}/edit',[ExpenditureController::class,'edit'])->name('expenditures.edit');
    Route::get('/admin/riwayat-pengeluaran',[ExpenditureController::class,'show'])->name('expenditures.history');
    Route::delete('/admin/pengeluaran/delete/{id}',[ExpenditureController::class,'delete'])->name('expenditures.delete');
    
    Route::get('/admin/kasir',[CashierController::class,'index'])->name('cashier.index');
    Route::get('/admin/kasir/print/',[CashierController::class,'print'])->name('cashier.print');
    Route::get('/admin/kasir/riwayat',[CashierController::class,'history'])->name('cashier.riwayat');
    Route::get('/admin/kasir/laporan',[CashierController::class,'report'])->name('cashier.report');
    Route::get('/admin/kasir/print-pdf',[CashierController::class,'generatePDF'])->name('cashier.pdf');
    Route::get('/admin/kasir/excel',[CashierController::class,'excel'])->name('cashier.excel');
    Route::get('/admin/detail-belanja/{code}',[CashierController::class,'show'])->name('cashier.show');
    Route::get('/cashier/print/{code}', [CashierController::class, 'reprint'])->name('cashier.reprint');

    Route::get('/laporan-laba-rugi',[CashierController::class, 'laba_rugi'])->name('laba.rugi');

        
});