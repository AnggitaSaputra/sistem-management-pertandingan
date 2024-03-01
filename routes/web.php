<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::middleware(['guest'])->group(function () { 
    Route::controller(AuthController::class)->group(function () {
        Route::match(['get', 'post'], '/', 'index')->name('login');
        Route::match(['get', 'post'], '/register', 'register')->name('register');
    });
});
Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::controller(DashboardController::class)->group(function() {
            Route::get('/', 'index')->name('dashboard');
        });
        Route::controller(AuthController::class)->group(function () {
            Route::get('/logout', 'Logout')->name('logout');
        });
    });
});
