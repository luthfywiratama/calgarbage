<?php

use App\Http\Controllers\Admin\AuthenticationController;
use App\Http\Controllers\Admin\GarbageTypeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\HomeController as ControllersHomeController;
use App\Http\Controllers\TransactionController;
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

Route::get('/', [ControllersHomeController::class,'home'])->name('home');

Route::post('transaction',[TransactionController::class,'transaction'])->name('transaction');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/', [HomeController::class, 'home'])->name('home');
        Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');

        Route::resource('garbage-type',GarbageTypeController::class);
        Route::resource('transaction',AdminTransactionController::class);

    });

    Route::get('login', [AuthenticationController::class, 'loginPage'])->name('login');
    Route::post('login', [AuthenticationController::class, 'login'])->name('login');

});
