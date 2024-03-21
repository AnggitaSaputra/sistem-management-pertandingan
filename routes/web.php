<?php

use App\Http\Controllers\AtletController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalPertandinganController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\UserController;
use App\Models\Tim;
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
            Route::match(['GET', 'POST'], '/profile/{id}', 'Profile')->name('profile');
            Route::match(['GET', 'POST'], '/change-password/{id}', 'changePassword')->name('change.password');
        });
        Route::controller(AuthController::class)->group(function () {
            Route::get('/logout', 'Logout')->name('logout');
        });
    });
    Route::prefix('user')->group(function () {
        Route::controller(UserController::class)->group(function() {
            Route::match(['GET', 'POST'], '/', 'index')->name('user');
            Route::match(['GET', 'POST'], '/update/{id}', 'update')->name('user.update');
            Route::match(['GET'], '/delete/{id}', 'delete')->name('user.delete');
        });
    });
    Route::prefix('tim')->group(function () {
        Route::controller(TimController::class)->group(function() {
            Route::match(['GET', 'POST'], '/', 'index')->name('tim');
            Route::match(['GET', 'POST'], '/update/{id}', 'update')->name('tim.update');
            Route::match(['GET'], '/delete/{id}', 'delete')->name('tim.delete');
            Route::prefix('list/user')->group(function() {
                Route::match(['GET', 'POST'], '/{id}', 'list')->name('tim.list');
                Route::match(['GET', 'POST'], '/update/{id}', 'updateList')->name('tim.list.update');
                Route::match(['GET'], '/delete/{id}', 'deleteList')->name('tim.list.delete');
            });
            
        });
    });
    Route::prefix('pembayaran')->group(function () {
        Route::controller(PembayaranController::class)->group(function() {
            Route::match(['GET', 'POST'], '/', 'index')->name('pembayaran');
            Route::match(['GET', 'POST'], '/update/{id}', 'update')->name('pembayaran.update');
            Route::match(['GET'], '/delete/{id}', 'delete')->name('pembayaran.delete');
        });
    });
    Route::prefix('kelas')->group(function () {
        Route::controller(KelasController::class)->group(function() {
            Route::match(['GET', 'POST'], '/', 'index')->name('kelas');
            Route::match(['GET', 'POST'], '/update/{id}', 'update')->name('kelas.update');
            Route::match(['GET'], '/delete/{id}', 'delete')->name('kelas.delete');
            Route::prefix('list/user')->group(function() {
                Route::match(['GET', 'POST'], '/{id}', 'list')->name('kelas.list');
                Route::match(['GET', 'POST'], '/update/{id}', 'updateList')->name('kelas.list.update');
                Route::match(['GET'], '/delete/{id}', 'deleteList')->name('kelas.list.delete');
            });
        });
    });
    Route::prefix('kategori')->group(function () {
        Route::controller(KategoriController::class)->group(function() {
            Route::match(['GET', 'POST'], '/', 'index')->name('kategori');
            Route::match(['GET', 'POST'], '/update/{id}', 'update')->name('kategori.update');
            Route::match(['GET'], '/delete/{id}', 'delete')->name('kategori.delete');
        });
    });
    Route::prefix('jadwal/pertandingan')->group(function () {
        Route::controller(JadwalPertandinganController::class)->group(function() {
            Route::match(['GET', 'POST'], '/', 'index')->name('jadwal');
            Route::match(['GET', 'POST'], '/update/{id}', 'update')->name('jadwal.update');
            Route::match(['GET'], '/delete/{id}', 'delete')->name('jadwal.delete');
            Route::prefix('list/tim')->group(function() {
                Route::match(['GET', 'POST'], '/{id}', 'list')->name('jadwalpertandingan.list');
                Route::match(['GET', 'POST'], '/update/{id}', 'updateList')->name('jadwalpertandingan.list.update');
                Route::match(['GET'], '/delete/{id}', 'deleteList')->name('jadwalpertandingan.list.delete');
                Route::prefix('atlet')->group(function() {
                    Route::match(['GET', 'POST'], '/{id}', 'listAtlet')->name('jadwalpertandingan.list.atlet');
                    Route::match(['GET', 'POST'], '/update/{id}', 'updateListAtlet')->name('jadwalpertandingan.list.update.atlet');
                    Route::match(['GET'], '/delete/{id}', 'deleteListAtlet')->name('jadwalpertandingan.list.delete.atlet');
                });
            });
        });
    });
    Route::prefix('atlet')->group(function () {
        Route::controller(AtletController::class)->group(function() {
            Route::match(['GET', 'POST'], '/', 'index')->name('atlet');
            Route::match(['GET', 'POST'], '/update/{id}', 'update')->name('atlet.update');
            Route::match(['GET'], '/delete/{id}', 'delete')->name('atlet.delete');
        });
    });
});
