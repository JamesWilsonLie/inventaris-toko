<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    GameController,
    AkunController,
    ItemController,
    AkunItemController
};

Route::middleware('auth')->group(function () {

    Route::get('/', [AkunController::class, 'home'])->name('index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/games', [GameController::class, 'index'])->name('games.index');
    Route::get('/games/create', [GameController::class, 'create'])->name('games.create');
    Route::post('/games', [GameController::class, 'store'])->name('games.store');
    Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');
    Route::get('/games/{game}/edit', [GameController::class, 'edit'])->name('games.edit');
    Route::put('/games/{game}', [GameController::class, 'update'])->name('games.update');
    Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy');

    Route::get('/akun', [AkunController::class, 'index'])->name('akun.index');
    Route::get('/akun/create', [AkunController::class, 'create'])->name('akun.create');
    Route::post('/akun', [AkunController::class, 'store'])->name('akun.store');
    Route::get('/akun/{id}', [AkunController::class, 'show'])->name('akun.show');
    Route::get('/akun/{akun}/edit', [AkunController::class, 'edit'])->name('akun.edit');
    Route::put('/akun/{akun}', [AkunController::class, 'update'])->name('akun.update');
    Route::delete('/akun/{akun}', [AkunController::class, 'destroy'])->name('akun.destroy');

    Route::get('/item', [ItemController::class, 'index'])->name('item.index');
    Route::get('/item/create', [ItemController::class, 'create'])->name('item.create');
    Route::post('/item', [ItemController::class, 'store'])->name('item.store');
    Route::get('/item/{item}', [ItemController::class, 'show'])->name('item.show');
    Route::get('/item/{item}/edit', [ItemController::class, 'edit'])->name('item.edit');
    Route::put('/item/{item}', [ItemController::class, 'update'])->name('item.update');
    Route::delete('/item/{item}', [ItemController::class, 'destroy'])->name('item.destroy');

    Route::get('/akun/{akun}/items', [AkunItemController::class, 'index'])->name('akun_item.index');
    Route::get('/akun/{akun}/items/create', [AkunItemController::class, 'create'])->name('akun_item.create');
    Route::post('/akun/{akun}/items', [AkunItemController::class, 'store'])->name('akun_item.store');
    Route::get('/akun/{akun}/items/{akunItem}', [AkunItemController::class, 'show'])->name('akun_item.show');
    Route::get('/akun/{akun}/items/{akunItem}/edit', [AkunItemController::class, 'edit'])->name('akun_item.edit');
    Route::put('/akun/{akun}/items/{akunItem}', [AkunItemController::class, 'update'])->name('akun_item.update');
    Route::delete('/akun/{akun}/items/{akunItem}', [AkunItemController::class, 'destroy'])->name('akun_item.destroy');
});

require __DIR__.'/auth.php';
