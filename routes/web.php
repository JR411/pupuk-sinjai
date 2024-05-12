<?php

use App\Http\Controllers\DesaController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\InformasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PemerintahController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\UserController;

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

Route::get('/', [LoginController::class, 'login'])->name('login')->middleware('masuk');
Route::post('/autentikasi', [LoginController::class, 'autentikasi']);
Route::post('/keluar', [LoginController::class, 'keluar']);

Route::get('/daftar-petani', [LoginController::class, 'petani']);
Route::get('/daftar-distributor', [LoginController::class, 'distributor']);
Route::post('/store', [LoginController::class, 'store']);

Route::get('/petani/proses', [PetaniController::class, 'proses'])->middleware(['petani', 'auth']);
Route::get('/petani/profil-distributor', [PetaniController::class, 'profil'])->middleware(['petani', 'auth']);
Route::get('/petani/riwayat-pesanan', [PetaniController::class, 'riwayat'])->middleware(['petani', 'auth']);
Route::resource('/petani', PetaniController::class)->except('create', 'store', 'show')->middleware('auth');

Route::get('/distributor/data-pengiriman', [DistributorController::class, 'pengiriman'])->middleware(['distributor', 'auth']);
Route::get('/distributor/riwayat-pesanan', [DistributorController::class, 'riwayat'])->middleware(['distributor', 'auth']);
Route::resource('/distributor', DistributorController::class)->middleware('auth');

// Route::get('/pemerintah/validasi-petani', [PemerintahController::class, 'petani'])->middleware(['pemerintah', 'auth']);
// Route::get('/pemerintah/validasi-distributor', [PemerintahController::class, 'distributor'])->middleware(['pemerintah', 'auth']);
Route::resource('/pemerintah/data-desa', DesaController::class)->except('edit', 'show')->middleware(['pemerintah', 'auth']);
Route::get('/pemerintah/riwayat-pesanan', [PemerintahController::class, 'riwayat'])->middleware(['pemerintah', 'auth']);
Route::get('/pemerintah', [PemerintahController::class, 'index'])->middleware(['pemerintah', 'auth']);

Route::resource('/pemerintah/akun', UserController::class)->except('create', 'store', 'show')->middleware(['pemerintah', 'auth']);

Route::resource('/pesan', PesanController::class)->except('index', 'create', 'show', 'destroy')->middleware('auth');

Route::resource('/informasi-pupuk', InformasiController::class)->middleware('auth');
