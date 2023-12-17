<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/registrasi-mahasiswa', [App\Http\Controllers\HomeController::class, 'resgiter'])->name('registrasi-mahasiswa');
Route::get('/tambah-mahasiswa', [App\Http\Controllers\HomeController::class, 'tambah'])->name('tambah-mahasiswa');
Route::post('/tambah-mahasiswa', [App\Http\Controllers\HomeController::class, 'store'])->name('store-mahasiswa');
Route::get('/detail-mahasiswa/{id}', [App\Http\Controllers\HomeController::class, 'detailMahasiswa'])->name('detail-mahasiswa');
Route::post('/detail-mahasiswa/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('update-mahasiswa');
Route::post('/detail-mahasiswa/diterima/{id}', [App\Http\Controllers\HomeController::class, 'diterima'])->name('diterima-mahasiswa');
Route::post('/detail-mahasiswa/ditolak/{id}', [App\Http\Controllers\HomeController::class, 'ditolak'])->name('ditolak-mahasiswa');

Route::get('/provinces', [App\Http\Controllers\DependantDropdownController::class, 'provinces'])->name('provinces');
Route::get('/cities', [App\Http\Controllers\DependantDropdownController::class, 'cities'])->name('cities');
Route::get('/districts', [App\Http\Controllers\DependantDropdownController::class, 'districts'])->name('districts');
Route::get('/villages', [App\Http\Controllers\DependantDropdownController::class, 'villages'])->name('villages');
