<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AkunItemController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::post('/games', [GameController::class, 'store'])->name('games.store');
Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy');

Route::get('/akun', [AkunController::class, 'index'])->name('akun.index');
Route::get('/akun/{id}', [AkunController::class, 'show'])->name('akun.show');
Route::post('/akun', [AkunController::class, 'store'])->name('akun.store');
Route::delete('/akun/{akun}', [AkunController::class, 'destroy'])->name('akun.destroy');


Route::get('/item', [ItemController::class, 'index'])->name('item.index');
Route::post('/item', [ItemController::class, 'store'])->name('item.store');
Route::put('/item/{item}', [ItemController::class, 'update'])->name('item.update');
Route::delete('/item/{item}', [ItemController::class, 'destroy'])->name('item.destroy');

Route::get('/akun/{akun_id}/items', [AkunItemController::class, 'index'])->name('akun_item.index');
Route::post('/akun/{akun_id}/items', [AkunItemController::class, 'store'])->name('akun_item.store');
Route::delete('/akun/{akun_id}/items/{akunItem}', [AkunItemController::class, 'destroy'])->name('akun_item.destroy');
