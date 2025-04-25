<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomingItemController;
use App\Http\Controllers\OutgoingItemController;

Route::get('login', [AuthController::class, 'loginView'])->name('login');
Route::post('loginSubmit', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::get('register', [AuthController::class, 'registerView'])->name('register');
Route::post('registerSubmit', [AuthController::class, 'registerSubmit'])->name('register.submit');


Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('barang-masuk/pencatatan', [IncomingItemController::class, 'inputForm'])->name('incomingItems.form');
    Route::get('barang-masuk/daftar', [IncomingItemController::class, 'listView'])->name('incomingItems.list');
    Route::get('barang-keluar/pencatatan', [OutgoingItemController::class, 'inputForm'])->name('outgoingItems.form');
    Route::get('barang-keluar/daftar', [OutgoingItemController::class, 'listView'])->name('outgoingItems.list');
    Route::get('daftar-barang', [ItemController::class, 'itemListView'])->name('itemList.view');
});
