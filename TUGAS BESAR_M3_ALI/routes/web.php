<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

Route::get('/', [BarangController::class, 'index'])->name('katalog.index');
Route::post('/barang', [BarangController::class, 'store'])->name('katalog.store');


Route::get('/barang/{sku}/edit', [BarangController::class, 'edit'])->name('katalog.edit');
Route::put('/barang/{sku}', [BarangController::class, 'update'])->name('katalog.update');

Route::delete('/barang/{sku}', [BarangController::class, 'destroy'])->name('katalog.destroy');