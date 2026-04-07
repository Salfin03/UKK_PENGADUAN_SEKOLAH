<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

// DEFAULT LOGIN & REGISTER
Route::get('/login', function () {
    return redirect()->route('login.siswa');
})->name('login');

Route::get('/register', function () {
    return redirect()->route('register.siswa');
})->name('register');

// REGISTER AREA
Route::get('/register/siswa', [RegisterController::class, 'indexSiswa'])->name('register.siswa');
Route::post('/register/siswa', [RegisterController::class, 'storeSiswa'])->name('register.siswa.store');

// LOGIN AREA
Route::get('/login/admin', [LoginController::class, 'indexAdmin'])->name('login.admin');
Route::post('/login/admin', [LoginController::class, 'loginAdmin']);

Route::get('/login/siswa', [LoginController::class, 'indexSiswa'])->name('login.siswa');
Route::post('/login/siswa', [LoginController::class, 'loginSiswa']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/kategori', [AdminController::class, 'storeKategori'])->name('admin.kategori.store');
    Route::put('/aspirasi/{id}', [AdminController::class, 'update'])->name('admin.aspirasi.update');
    Route::post('/aspirasi/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.aspirasi.status');
    Route::post('/aspirasi/{id}/feedback', [AdminController::class, 'updateFeedback'])->name('admin.aspirasi.feedback');
    Route::delete('/aspirasi/{id}', [AdminController::class, 'destroy'])->name('admin.aspirasi.destroy');
});

Route::middleware('auth:siswa')->prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::post('/aspirasi', [SiswaController::class, 'store'])->name('siswa.aspirasi.store');
    Route::delete('/aspirasi/{id}', [SiswaController::class, 'destroy'])->name('siswa.aspirasi.destroy');
});
