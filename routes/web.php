<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;


// agar ketika user sudah login tidak bisa mengakses halaman login
Route::middleware(['guest:karyawan'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/proseslogin', [AuthController::class, 'proseslogin'])->name('proseslogin');
});

Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('login.admin');

    Route::post('/prosesloginadmin', [AuthController::class, 'prosesloginadmin'])->name('proses.login.admin');

});


Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/proseslogout', [AuthController::class, 'proseslogout'])->name('proseslogout');

    Route::get('/presensi/create', [PresensiController::class, 'create'])->name('presensi.create');
    Route::post('/presensi/store', [PresensiController::class, 'store'])->name('presensi.store');
    Route::get('/presensi/editprofile', [PresensiController::class, 'editprofile'])->name('presensi.editprofile');
    Route::post('/presensi/{nik}/update', [PresensiController::class, 'updateprofile'])->name('presensi.updateprofile');
    // histori
    Route::get('/presensi/histori', [PresensiController::class, 'histori'])->name('presensi.histori');
    Route::post('/gethistori', [PresensiController::class, 'gethistori'])->name('presensi.gethistori');

    // izin
    Route::get('/presensi/izin', [PresensiController::class, 'izin'])->name('presensi.izin');
    Route::get('/presensi/buatizin', [PresensiController::class, 'buatizin'])->name('presensi.buatizin');
    Route::post('/presensi/storeizin', [PresensiController::class, 'storeizin'])->name('presensi.storeizin');
});

// ------------ untuk dashboard admin
Route::middleware(['auth:user'])->group(function () {
    Route::get('/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin'])->name('proseslogout.admin');
    // utk memebedakan auth karayawan
    Route::get('/panel/dashboardadmin', [DashboardController::class, 'dashboardadmin'])->name('dashboardadmin');

    // karyawan
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
});
