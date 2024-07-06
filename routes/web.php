<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

    // Route untuk melihat daftar peminjaman
    Route::get('/borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');

    // Route untuk melihat formulir pembuatan peminjaman baru
    Route::get('/borrowings/create', [BorrowingController::class, 'create'])->name('borrowings.create');

    // Route untuk menyimpan peminjaman baru
    Route::post('/borrowings', [BorrowingController::class, 'store'])->name('borrowings.store');

    // Route untuk melihat detail peminjaman tertentu
    Route::get('/borrowings/{borrowing}', [BorrowingController::class, 'show'])->name('borrowings.show');

    // Route untuk melihat formulir pengeditan peminjaman tertentu
    Route::get('/borrowings/{borrowing}/edit', [BorrowingController::class, 'edit'])->name('borrowings.edit');

    // Route untuk memperbarui peminjaman tertentu
    Route::put('/borrowings/{borrowing}', [BorrowingController::class, 'update'])->name('borrowings.update');

    // Route untuk menghapus peminjaman tertentu
    Route::delete('/borrowings/{borrowing}', [BorrowingController::class, 'destroy'])->name('borrowings.destroy');

//Route Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login-proses', [AuthController::class, 'login'])->name('login.proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Route Register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register-proses', [AuthController::class, 'register'])->name('register.proses');

//Route Dashboard
Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/user/dashboard', [HomeController::class, 'userDashboard'])->name('user.dashboard');

//Route Peminjaman
Route::get('/user/peminjaman', [BorrowingController::class, 'Peminjaman'])->name('peminjaman');

Route::get('/admin/user', [AuthController::class, 'User'])->name('admin.user');
Route::post('/admin/user', [AuthController::class, 'store'])->name('admin.user.store');
Route::put('/admin/user/{id}/update', [AuthController::class, 'update'])->name('admin.user.update');
Route::get('/admin/user/{id}/destroy', [AuthController::class, 'destroy'])->name('admin.user.destroy');

Route::get('/admin/kategori', [CategoryController::class, 'Kategori'])->name('admin.kategori');
Route::post('/admin/kategori', [CategoryController::class, 'store'])->name('admin.kategori.store');
Route::put('/admin/kategori/{id}/update', [CategoryController::class, 'update'])->name('admin.kategori.update');
Route::get('/admin/kategori/{id}/destroy', [CategoryController::class, 'destroy'])->name('admin.kategori.destroy');

Route::get('/admin/fasilitas', [FacilityController::class, 'Fasilitas'])->name('admin.fasilitas');
Route::post('/admin/fasilitas', [FacilityController::class, 'store'])->name('admin.fasilitas.store');
Route::put('/admin/fasilitas/{id}/update', [FacilityController::class, 'update'])->name('admin.fasilitas.update');
Route::get('/admin/fasilitas/{id}/destroy', [FacilityController::class, 'destroy'])->name('admin.fasilitas.destroy');

Route::get('/admin/peminjaman', [BorrowingController::class, 'Peminjaman'])->name('admin.peminjaman');
Route::post('/admin/peminjaman', [BorrowingController::class, 'store'])->name('admin.peminjaman.store');
Route::put('/admin/peminjaman/{id}/update', [BorrowingController::class, 'update'])->name('admin.peminjaman.update');
Route::get('/admin/peminjaman/{id}/destroy', [BorrowingController::class, 'destroy'])->name('admin.peminjaman.destroy');

Route::get('/admin/peminjaman', [BorrowingController::class, 'adminPeminjaman'])->name('admin.peminjaman');
Route::get('/admin/fasilitas', [FacilityController::class, 'Fasilitas'])->name('admin.fasilitas');
Route::get('/admin/laporan', [BorrowingController::class, 'adminPeminjaman'])->name('admin.laporan');