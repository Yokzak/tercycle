<?php

use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return view('home');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', function () {
        return view('siswa.dashboard');
    });

    Route::get('/siswa/profil', function () {
        return view('siswa.profil');
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

    Route::get('/admin/siswa', function () {
        return view('admin.siswa');
    });

    Route::get('/admin/produk', function () {
        return view('admin.produk');
    });

    Route::get('/admin/transaksi', function () {
        return view('admin.transaksi');
    });
});

Route::get('/admin/profil', function () {
    return view('admin.profil');
});