<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminSiswaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SiswaProdukController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KategoriBotolController;
use App\Http\Controllers\PenukaranBotolController;
use App\Http\Controllers\SiswaKeranjangController;
use App\Http\Controllers\SiswaPesananController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProfilController;
use App\Http\Controllers\LoginController;


Route::get('/', function () {
    return view('home');
})->name('home');


Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/login', [LoginController::class, 'store'])->name('login');

    // Register
    Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
    Route::post('/register/check-student', [RegisterController::class, 'checkStudent'])->name('register.check-student');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    // Forgot Password
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');
});


Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/admin/kategori-produk', [KategoriProdukController::class, 'index'])->name('admin.kategori.index');
Route::post('/admin/kategori-produk', [KategoriProdukController::class, 'store'])->name('admin.kategori.store');
Route::delete('/admin/kategori-produk', [KategoriProdukController::class, 'destroy'])->name('admin.kategori.destroy');
Route::post('/admin/siswa', [AdminSiswaController::class, 'store'])->name('admin.siswa.store');

Route::middleware(['auth', 'role:siswa', 'no-cache'])->prefix('siswa')->name('siswa.')->group(function () {

        Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('dashboard');
        Route::get('/tukar', [PenukaranBotolController::class, 'create'])->name('tukar');
        Route::post('/tukar', [PenukaranBotolController::class, 'store'])->name('tukar.store');
        Route::get('/profil', [SiswaController::class, 'profil'])->name('profil');
        Route::put('/profil', [SiswaController::class, 'updateProfil'])->name('profil.update');
        Route::get('/poin', [SiswaController::class, 'poin'])->name('poin');
        Route::get('/pesanan', [SiswaPesananController::class, 'index'])->name('pesanan');
        Route::post('/pesanan', [SiswaPesananController::class, 'store'])->name('pesanan.store');
        Route::patch('/pesanan/{pesanan}/proses',[SiswaPesananController::class, 'process'])->name('pesanan.process');
        Route::patch('/pesanan/{pesanan}/selesai', [SiswaPesananController::class, 'selesai'])->name('pesanan.selesai');

        // PRODUK
        Route::get('/produk', [SiswaProdukController::class, 'index'])->name('produk.index');
        Route::post('/produk', [SiswaProdukController::class, 'store'])->name('produk.store');
        Route::get('/produk-saya', [SiswaProdukController::class, 'produkSaya'])->name('produk-saya');

        // KERANJANG
        Route::get('/keranjang', [SiswaKeranjangController::class, 'index'])->name('keranjang.index');
        Route::post('/keranjang/{produk}', [SiswaKeranjangController::class, 'store'])->name('keranjang.store');
        Route::patch('/keranjang/detail/{detail}/increase', [SiswaKeranjangController::class, 'increase'])->name('keranjang.increase');
        Route::patch('/keranjang/detail/{detail}/decrease', [SiswaKeranjangController::class, 'decrease'])->name('keranjang.decrease');
        Route::delete('/keranjang/detail/{detail}', [SiswaKeranjangController::class, 'destroy'])->name('keranjang.destroy');
        Route::delete('/keranjang', [SiswaKeranjangController::class, 'clear'])->name('keranjang.clear');
});

Route::middleware(['auth', 'role:admin', 'no-cache'])->group(function () {

    Route::get('/admin/profil', [AdminProfilController::class, 'index'])->name('admin.profil.index');
    Route::put('/admin/profil', [AdminProfilController::class, 'update'])->name('admin.profil.update');
    Route::put('/admin/profil/password', [AdminProfilController::class, 'updatePassword'])->name('admin.profil.password');

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/penukaran', [PenukaranBotolController::class, 'index'])->name('admin.penukaran');
    Route::post('/admin/penukaran/cari', [PenukaranBotolController::class, 'cariSiswa'])->name('admin.penukaran.cari');
    Route::post('/admin/penukaran/offline', [PenukaranBotolController::class, 'storeOffline'])->name('admin.penukaran.offline');
    Route::patch('/admin/penukaran/{penukaran}/setujui', [PenukaranBotolController::class, 'setujui'])->name('admin.penukaran.setujui');
    Route::patch('/admin/penukaran/{penukaran}/tolak', [PenukaranBotolController::class, 'tolak'])->name('admin.penukaran.tolak');

    Route::get('/admin/siswa', [AdminSiswaController::class, 'index'])->name('admin.siswa.index');
    Route::post('/admin/siswa', [AdminSiswaController::class, 'store'])->name('admin.siswa.store');
    Route::put('/admin/siswa/{siswa}', [SiswaController::class, 'update'])->name('admin.siswa.update');

    Route::get('/admin/jurusan', [AdminSiswaController::class, 'index'])->name('admin.jurusan.index');
    Route::post('/admin/jurusan', [JurusanController::class, 'store'])->name('admin.jurusan.store');
    Route::delete('/admin/jurusan', [JurusanController::class, 'destroy'])->name('admin.jurusan.destroy');

    Route::get('/admin/botol', [KategoriBotolController::class, 'index'])->name('admin.botol.index');
    Route::post('/admin/botol', [KategoriBotolController::class, 'store'])->name('admin.botol.store');
    Route::put('/admin/botol/{id}', [KategoriBotolController::class, 'update'])->name('admin.botol.update');
    Route::delete('/admin/botol/{kategoriBotol}', [KategoriBotolController::class, 'destroy'])->name('admin.botol.destroy');

    Route::get('/admin/kategori-produk', [KategoriProdukController::class, 'index'])->name('admin.kategori.index');
    Route::post('/admin/kategori-produk', [KategoriProdukController::class, 'store'])->name('admin.kategori.store');
    Route::delete('/admin/kategori-produk', [KategoriProdukController::class, 'destroy'])->name('admin.kategori.destroy');

    Route::get('/admin/produk', [AdminProdukController::class, 'index'])->name('admin.produk');
    Route::patch('/admin/produk/{produk}/approve', [AdminProdukController::class, 'approve'])->name('admin.produk.approve');
    Route::delete('/admin/produk/{produk}/reject', [AdminProdukController::class, 'reject'])->name('admin.produk.reject');

    Route::get('/admin/transaksi', function () {
        return view('admin.transaksi');
    })->name('admin.transaksi');

});
