<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\OutFacilityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
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


// Route Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login-proses', [AuthController::class, 'login'])->name('login.proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register-proses', [AuthController::class, 'register'])->name('register.proses');

// Route Dashboard untuk User
Route::middleware(['auth', 'checkrole:user', 'PreventBackHistory'])->group(function () {
    Route::get('/user/dashboard', [HomeController::class, 'userDashboard'])->name('user.dashboard');

    Route::get('/user/peminjaman', [BorrowingController::class, 'PeminjamanUser'])->name('user.peminjaman');
    Route::post('/user/peminjaman', [BorrowingController::class, 'storeUser'])->name('user.peminjaman.store');

    Route::get('/user/fasilitas', [FacilityController::class, 'FasilitasUser'])->name('user.fasilitas');
    Route::get('/user/fasilitaskeluar', [OutFacilityController::class, 'FasilitasKeluarUser'])->name('user.fasilitaskeluar');
    Route::get('/user/laporan', [ReportController::class, 'userLaporan'])->name('user.laporan');
});

// Route Dashboard untuk Admin
Route::middleware(['auth', 'checkrole:admin', 'PreventBackHistory'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');

    Route::get('/admin/user', [AuthController::class, 'User'])->name('admin.user');
    Route::post('/admin/user', [AuthController::class, 'store'])->name('admin.user.store');
    Route::put('/admin/user/{id_user}/update', [AuthController::class, 'update'])->name('admin.user.update');
    Route::get('/admin/user/{id_user}/destroy', [AuthController::class, 'destroy'])->name('admin.user.destroy');

    Route::get('/admin/kategori', [CategoryController::class, 'Kategori'])->name('admin.kategori');
    Route::post('/admin/kategori', [CategoryController::class, 'store'])->name('admin.kategori.store');
    Route::put('/admin/kategori/{id_category}/update', [CategoryController::class, 'update'])->name('admin.kategori.update');
    Route::get('/admin/kategori/{id_category}/destroy', [CategoryController::class, 'destroy'])->name('admin.kategori.destroy');

    Route::get('/admin/fasilitas', [FacilityController::class, 'Fasilitas'])->name('admin.fasilitas');
    Route::post('/admin/fasilitas', [FacilityController::class, 'store'])->name('admin.fasilitas.store');
    Route::put('/admin/fasilitas/{id_fasilitas}/update', [FacilityController::class, 'update'])->name('admin.fasilitas.update');
    Route::get('/admin/fasilitas/{id_fasilitas}/destroy', [FacilityController::class, 'destroy'])->name('admin.fasilitas.destroy');

    Route::get('/admin/fasilitaskeluar', [OutFacilityController::class, 'FasilitasKeluar'])->name('admin.fasilitaskeluar');
    Route::post('/admin/fasilitaskeluar', [OutFacilityController::class, 'store'])->name('admin.fasilitaskeluar.store');

    Route::get('/admin/peminjaman', [BorrowingController::class, 'PeminjamanAdmin'])->name('admin.peminjaman');
    Route::post('/admin/peminjaman', [BorrowingController::class, 'storeAdmin'])->name('admin.peminjaman.store');

    Route::get('/admin/laporan', [ReportController::class, 'adminLaporan'])->name('admin.laporan');
    Route::put('/admin/laporan/{id_borrowing}/update', [ReportController::class, 'update'])->name('admin.laporan.update');
    Route::get('/admin/laporan/{id_borrowing}/destroy', [ReportController::class, 'destroy'])->name('admin.laporan.destroy');
});
