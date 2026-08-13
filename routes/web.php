<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminSiswaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\SiswaProdukController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KategoriBotolController;

Route::get('/', function () {
    return view('home');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::middleware('auth')->group(function () {
    Route::get('/siswa/produk', [SiswaProdukController::class, 'index'])
        ->name('siswa.produk.index');

    Route::post('/siswa/produk', [SiswaProdukController::class, 'store'])
        ->name('siswa.produk.store');
});

Route::delete('/admin/kategori-produk', [KategoriProdukController::class, 'destroy'])->name('admin.kategori.destroy');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/admin/kategori-produk', [KategoriProdukController::class, 'index'])->name('admin.kategori.index');

Route::post('/admin/kategori-produk', [KategoriProdukController::class, 'store'])->name('admin.kategori.store');

Route::delete('/admin/kategori-produk', [KategoriProdukController::class, 'destroy'])->name('admin.kategori.destroy');

Route::get('/admin/siswa', [AdminSiswaController::class, 'index'])->name('admin.siswa.index');

Route::post('/admin/siswa', [AdminSiswaController::class, 'store'])->name('admin.siswa.store');

Route::get('/siswa/qr', [SiswaController::class, 'qr'])->middleware('auth')->name('siswa.qr');

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', function () {
        return view('siswa.dashboard');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/siswa/profil', [SiswaController::class, 'profil'])
            ->name('siswa.profil');

        Route::put('/siswa/profil', [SiswaController::class, 'updateProfil'])
            ->name('siswa.profil.update');
    });

    Route::get('/siswa/poin', function () {
        return view('siswa.poin');
    });

    Route::get('/siswa/tukar', function () {
        return view('siswa.tukar');
    });

    Route::get('/siswa/pesanan', function () {
        return view('siswa.pesanan');
    });

    Route::get('/siswa/keranjang', function () {
        return view('siswa.keranjang');
    });
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/admin/penukaran', function () {
        return view('admin.penukaran');
    });

    Route::get('/admin/jurusan', [JurusanController::class, 'index'])
        ->name('admin.jurusan.index');

    Route::post('/admin/jurusan', [JurusanController::class, 'store'])
        ->name('admin.jurusan.store');

    Route::delete('/admin/jurusan', [JurusanController::class, 'destroy'])
        ->name('admin.jurusan.destroy');

    Route::get('/admin/botol', [KategoriBotolController::class, 'index'])
        ->name('admin.botol.index');

    Route::post('/admin/botol', [KategoriBotolController::class, 'store'])
        ->name('admin.botol.store');

    Route::delete('/admin/botol/{kategoriBotol}', [KategoriBotolController::class, 'destroy'])
        ->name('admin.botol.destroy');

    Route::get('/admin/siswa', [AdminSiswaController::class, 'index'])->name('admin.siswa.index');

    Route::get('/admin/produk', function () {
        return view('admin.produk');
    });

    Route::get('/admin/transaksi', function () {
        return view('admin.transaksi');
    });

    Route::get('/admin/profil', function () {
        return view('admin.profil');
    });
});