<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UploadTransactionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\JasaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/upload', [UploadTransactionController::class, 'upload']);
Route::get('/transactions', [UploadTransactionController::class, 'datatable'])->name('transaction.datatable');
Route::get('/tags', [TagController::class, 'datatable'])->name('tag.datatable');
Route::get('/product', [ProductController::class, 'datatable'])->name('product.datatable');
Route::get('/jasa', [JasaController::class, 'datatable'])->name('jasa.datatable');
