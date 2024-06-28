<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UploadTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\JasaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionJasaController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/transaction', [UploadTransactionController::class, 'index'])->name('transaction');
Route::post('/transaction/upload', [UploadTransactionController::class, 'upload'])->name('transaction.upload');
Route::get('/transaction/success-row/{id}', [UploadTransactionController::class, 'downloadSuccessRow'])->name('transaction.success_row');
Route::get('/transaction/failed-row/{id}', [UploadTransactionController::class, 'downloadFailedRow'])->name('transaction.failed_row');

Route::get('/tag', [TagController::class, 'index'])->name('tag');
Route::post('/tag', [TagController::class, 'store'])->name('tag.store');
Route::put('/tag/{id}', [TagController::class, 'update'])->name('tag.update');
Route::delete('/tag/{id}', [TagController::class, 'delete'])->name('tag.destroy');

Route::get('/produk', [ProductController::class, 'index'])->name('produk');
Route::post('/produk', [ProductController::class, 'store'])->name('produk.store');
Route::put('/produk/{id}', [ProductController::class, 'update'])->name('produk.update');
Route::delete('/produk/{id}', [ProductController::class, 'delete'])->name('produk.destroy');

Route::get('/jasa', [JasaController::class, 'index'])->name('jasa');
Route::post('/jasa', [JasaController::class, 'store'])->name('jasa.store');
Route::put('/jasa/{id}', [JasaController::class, 'update'])->name('jasa.update');
Route::delete('/jasa/{id}', [JasaController::class, 'delete'])->name('jasa.destroy');

Route::get('/transaksi-jasa', [TransactionJasaController::class, 'index'])->name('transaction_jasa');
