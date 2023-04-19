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
Route::post('/register', [GuestController::class, 'register'])->middleware('guest')->name('register');

Route::group(['middleware' => ['role.mahasiswa']], function () {
    Route::prefix('mahasiswa')->group(function () {
        // Route Home Mahasiswa
        Route::get('/', [MahasiswaController::class, 'index'])->name('mahasiswa.index');

        // Menu Media
        Route::prefix('media')->group(function () {
            Route::get('/', [MahasiswaController::class, 'media'])->name('mahasiswa.media');

            Route::get('/video', [MahasiswaController::class, 'video'])->name('mahasiswa.media.video');
            Route::get('/video/{id}', [MahasiswaController::class, 'detailVideo'])->name('mahasiswa.media.video.detail');

            Route::get('/anatomy_3d', [MahasiswaController::class, 'anatomy3d'])->name('mahasiswa.media.anatomy3d');
            Route::get('/anatomy_3d/{id}', [MahasiswaController::class, 'detailAnatomy3d'])->name('mahasiswa.media.anatomy3d.detail');
        });
    });
});

Route::group(['middleware' => ['role.dosen']], function () {
    Route::prefix('dosen')->group(function () {
        Route::get('/', [DosenController::class, 'index'])->name('dosen.index');
    });
});
