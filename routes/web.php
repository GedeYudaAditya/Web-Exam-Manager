<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
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

// profile
Route::get('/profile', [ProfileController::class, 'profile'])->middleware('auth')->name('profile');
Route::post('/profile/update', [ProfileController::class, 'profileUpdate'])->middleware('auth')->name('profile.update');

// about
Route::get('/about', [GuestController::class, 'about'])->middleware('guest')->name('about');

// contact
Route::get('/contact', [GuestController::class, 'contact'])->middleware('guest')->name('contact');

Route::group(['middleware' => ['role.mahasiswa']], function () {
    Route::prefix('mahasiswa')->group(function () {
        // Route Home Mahasiswa
        Route::get('/', [MahasiswaController::class, 'index'])->name('mahasiswa.index');

        // Menu Media
        Route::prefix('media')->group(function () {
            Route::get('/', [MahasiswaController::class, 'media'])->name('mahasiswa.media');

            Route::get('/video', [MahasiswaController::class, 'video'])->name('mahasiswa.media.video');
            Route::get('/video/{video:slug}', [MahasiswaController::class, 'detailVideo'])->name('mahasiswa.media.video.detail');

            Route::get('/anatomy_3d', [MahasiswaController::class, 'anatomy3d'])->name('mahasiswa.media.anatomy3d');
            Route::get('/anatomy_3d/{id}', [MahasiswaController::class, 'detailAnatomy3d'])->name('mahasiswa.media.anatomy3d.detail');
        });

        // Menu Test
        Route::prefix('test')->group(function () {
            Route::get('/', [MahasiswaController::class, 'test'])->name('mahasiswa.test');
            Route::post('makeAttampt/{test:slug}', [MahasiswaController::class, 'makeAttampt'])->name('mahasiswa.test.makeAttamp');

            Route::get('/report', [MahasiswaController::class, 'report'])->name('mahasiswa.test.report');
            Route::get('/result/{report:slug}', [MahasiswaController::class, 'result'])->name('mahasiswa.test.result');

            Route::prefix('paru-paru-test')->group(function () {
                Route::get('/', [MahasiswaController::class, 'paruParuTest'])->name('mahasiswa.test.paru-paru');
                Route::get('/soal/{test:slug}', [MahasiswaController::class, 'paruParuTestSoal'])->name('mahasiswa.test.paru-paru.soal');
            });

            Route::prefix('ginjal-test')->group(function () {
                Route::get('/', [MahasiswaController::class, 'ginjalTest'])->name('mahasiswa.test.ginjal');
                Route::get('/soal/{test:slug}', [MahasiswaController::class, 'ginjalTestSoal'])->name('mahasiswa.test.ginjal.soal');
            });

            Route::prefix('reproduksi-test')->group(function () {
                Route::get('/', [MahasiswaController::class, 'reproduksiTest'])->name('mahasiswa.test.reproduksi');
                Route::get('/soal/{test:slug}', [MahasiswaController::class, 'reproduksiTestSoal'])->name('mahasiswa.test.reproduksi.soal');
            });
        });
    });
});

Route::group(['middleware' => ['role.dosen']], function () {
    Route::prefix('dosen')->group(function () {
        Route::get('/', [DosenController::class, 'index'])->name('dosen.index');

        Route::prefix('manajemen-media')->group(function () {
            Route::get('/', [DosenController::class, 'media'])->name('dosen.media');
            Route::get('/detail/{video:slug}', [DosenController::class, 'mediaDetail'])->name('dosen.media.detail');

            Route::get('/create', [DosenController::class, 'mediaAdd'])->name('dosen.media.create');
            Route::post('/create', [DosenController::class, 'mediaStore'])->name('dosen.media.store');

            Route::get('/edit/{video:slug}', [DosenController::class, 'mediaEdit'])->name('dosen.media.edit');
            Route::post('/edit/{video:slug}', [DosenController::class, 'mediaUpdate'])->name('dosen.media.update');

            Route::delete('/delete/{video:slug}', [DosenController::class, 'mediaDelete'])->name('dosen.media.delete');

            // change status
            Route::get('/change-status/{video:slug}', [DosenController::class, 'ubahStatus'])->name('dosen.media.change-status');
        });

        Route::prefix('manajemen-test')->group(function () {
            Route::get('/', [DosenController::class, 'test'])->name('dosen.test');
            Route::get('/report', [DosenController::class, 'report'])->name('dosen.test.report');
            Route::get('/report/{report:slug}', [DosenController::class, 'detailReport'])->name('dosen.test.report.detail');

            Route::prefix('paru-paru-test')->group(function () {
                Route::get('/', [DosenController::class, 'paruParuTest'])->name('dosen.test.paru-paru');
                Route::get('/create', [DosenController::class, 'createParuParuTest'])->name('dosen.test.paru-paru.create');
                Route::post('/create', [TestController::class, 'storeParuParuTest'])->name('dosen.test.paru-paru.store');
                Route::get('/edit/{test:slug}', [DosenController::class, 'editParuParuTest'])->name('dosen.test.paru-paru.edit');
                Route::post('/edit/{test:slug}', [TestController::class, 'updateParuParuTest'])->name('dosen.test.paru-paru.update');
                Route::get('/delete/{test:slug}', [TestController::class, 'deleteParuParuTest'])->name('dosen.test.paru-paru.delete');
                Route::get('/update-status/{test:slug}', [TestController::class, 'updateStatusParuParuTest'])->name('dosen.test.paru-paru.update-status');

                Route::prefix('soal/{test:slug}')->group(function () {
                    Route::get('/', [DosenController::class, 'paruParuSoal'])->name('dosen.test.paru-paru.soal');
                    Route::get('/create', [DosenController::class, 'createParuParuSoal'])->name('dosen.test.paru-paru.soal.create');
                    Route::post('/create', [TestController::class, 'storeParuParuSoal'])->name('dosen.test.paru-paru.soal.store');
                    Route::get('/edit/{question:slug}', [DosenController::class, 'editParuParuSoal'])->name('dosen.test.paru-paru.soal.edit');
                    Route::post('/edit/{question:slug}', [TestController::class, 'updateParuParuSoal'])->name('dosen.test.paru-paru.soal.update');
                    Route::delete('/delete/{question:slug}', [TestController::class, 'deleteParuParuSoal'])->name('dosen.test.paru-paru.soal.delete');
                });
            });

            Route::prefix('ginjal-test')->group(function () {
                Route::get('/', [DosenController::class, 'ginjalTest'])->name('dosen.test.ginjal');
                Route::get('/create', [DosenController::class, 'createGinjalTest'])->name('dosen.test.ginjal.create');
                Route::post('/create', [TestController::class, 'storeGinjalTest'])->name('dosen.test.ginjal.store');
                Route::get('/edit/{test:slug}', [DosenController::class, 'editGinjalTest'])->name('dosen.test.ginjal.edit');
                Route::post('/edit/{test:slug}', [TestController::class, 'updateGinjalTest'])->name('dosen.test.ginjal.update');
                Route::get('/delete/{test:slug}', [TestController::class, 'deleteGinjalTest'])->name('dosen.test.ginjal.delete');
                Route::get('/update-status/{test:slug}', [TestController::class, 'updateStatusGinjalTest'])->name('dosen.test.ginjal.update-status');

                Route::prefix('soal/{test:slug}')->group(function () {
                    Route::get('/', [DosenController::class, 'ginjalSoal'])->name('dosen.test.ginjal.soal');
                    Route::get('/create', [DosenController::class, 'createGinjalSoal'])->name('dosen.test.ginjal.soal.create');
                    Route::post('/create', [TestController::class, 'storeGinjalSoal'])->name('dosen.test.ginjal.soal.store');
                    Route::get('/edit/{question:slug}', [DosenController::class, 'editGinjalSoal'])->name('dosen.test.ginjal.soal.edit');
                    Route::post('/edit/{question:slug}', [TestController::class, 'updateGinjalSoal'])->name('dosen.test.ginjal.soal.update');
                    Route::delete('/delete/{question:slug}', [TestController::class, 'deleteGinjalSoal'])->name('dosen.test.ginjal.soal.delete');
                });
            });

            Route::prefix('reproduksi-test')->group(function () {
                Route::get('/', [DosenController::class, 'reproduksiTest'])->name('dosen.test.reproduksi');
                Route::get('/create', [DosenController::class, 'createReproduksiTest'])->name('dosen.test.reproduksi.create');
                Route::post('/create', [TestController::class, 'storeReproduksiTest'])->name('dosen.test.reproduksi.store');
                Route::get('/edit/{test:slug}', [DosenController::class, 'editReproduksiTest'])->name('dosen.test.reproduksi.edit');
                Route::post('/edit/{test:slug}', [TestController::class, 'updateReproduksiTest'])->name('dosen.test.reproduksi.update');
                Route::get('/delete/{test:slug}', [TestController::class, 'deleteReproduksiTest'])->name('dosen.test.reproduksi.delete');
                Route::get('/update-status/{test:slug}', [TestController::class, 'updateStatusReproduksiTest'])->name('dosen.test.reproduksi.update-status');

                Route::prefix('soal/{test:slug}')->group(function () {
                    Route::get('/', [DosenController::class, 'reproduksiSoal'])->name('dosen.test.reproduksi.soal');
                    Route::get('/create', [DosenController::class, 'createReproduksiSoal'])->name('dosen.test.reproduksi.soal.create');
                    Route::post('/create', [TestController::class, 'storeReproduksiSoal'])->name('dosen.test.reproduksi.soal.store');
                    Route::get('/edit/{question:slug}', [DosenController::class, 'editReproduksiSoal'])->name('dosen.test.reproduksi.soal.edit');
                    Route::post('/edit/{question:slug}', [TestController::class, 'updateReproduksiSoal'])->name('dosen.test.reproduksi.soal.update');
                    Route::delete('/delete/{question:slug}', [TestController::class, 'deleteReproduksiSoal'])->name('dosen.test.reproduksi.soal.delete');
                });
            });

            // Acc and Dec User
            Route::get('/acc/{user:id}', [DosenController::class, 'accUser'])->name('dosen.test.user.acc');
            Route::get('/dec/{user:id}', [DosenController::class, 'decUser'])->name('dosen.test.user.dec');
            Route::get('/del/{user:id}', [DosenController::class, 'delUser'])->name('dosen.test.user.del');
        });

        Route::get('/export', [DosenController::class, 'exportHasil'])->name('dosen.export');
    });
});
