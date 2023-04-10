<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MahasiswaController;
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

Route::get('/', [GuestController::class, 'index'])->middleware('guest')->name('landing-page');
Route::post('/login', [GuestController::class, 'login'])->middleware('guest')->name('login');
Route::post('/logout', [GuestController::class, 'logout'])->middleware('auth')->name('logout');

Route::group(['middleware' => ['role.mahasiswa']], function () {
    Route::prefix('mahasiswa')->group(function () {
        Route::get('/', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    });
});

Route::group(['middleware' => ['role.dosen']], function () {
    Route::prefix('dosen')->group(function () {
        Route::get('/', [DosenController::class, 'index'])->name('dosen.index');
    });
});
