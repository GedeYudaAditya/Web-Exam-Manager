<?php

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

Route::get('/', [GuestController::class, 'index'])->name('landing-page');
Route::post('/login', [GuestController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::prefix('mahasiswa')->group(function () {
        Route::get('/', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    });
});

Route::group(['middleware' => ['auth', 'role']], function () {
    Route::prefix('dosen')->group(function () {
        Route::get('/', [DosenController::class, 'index'])->name('dosen.index');
    });
});
