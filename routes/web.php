<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminSiswaController;
use App\Http\Controllers\SiswaController;

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

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

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

    Route::get('/siswa/produk', function () {
        return view('siswa.produk');
    });

    Route::get('/siswa/pesanan', function () {
        return view('siswa.pesanan');
    });
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/admin/penukaran', function () {
        return view('admin.penukaran');
    });

    Route::get('/admin/botol', function () {
        return view('admin.botol');
    });

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