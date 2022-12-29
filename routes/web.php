<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\BantuanPkhController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\BantuanBnptController;
use App\Http\Controllers\LaporanPkhController;
use App\Http\Controllers\LaporanBnptController;

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/cart', [HomeController::class, 'cart'])->name('home.cart');

// route agama
Route::group(['prefix'=>'masterdata','middleware'=>'auth'],function(){
    Route::resource('agama',AgamaController::class);
    Route::resource('pekerjaan',PekerjaanController::class);
    Route::resource('kabupaten',KabupatenController::class);
    Route::resource('kecamatan',KecamatanController::class);
    Route::resource('desa',DesaController::class);
    Route::resource('penduduk',PendudukController::class);
    Route::get('/keluarga/findPenduduk',[KeluargaController::class,'findPenduduk'])->name('keluarga.findPenduduk');
    Route::get('/keluarga/findKeluarga',[KeluargaController::class,'findKeluarga'])->name('keluarga.findKeluarga');
    Route::resource('keluarga',KeluargaController::class);
});


// bantuan pkh
Route::group(['prefix'=>'bantuan','middleware'=>'auth'],function(){
    // pkh
    Route::post('/pkh/konfirmasi/{id}',[BantuanPkhController::class,'konfirmasi'])->name('pkh.konfirmasi');
    Route::get('/pkh/bagikan/aksi',[BantuanPkhController::class,'bagikanBantuanAction'])->name('pkh.bagikan.aksi');
    Route::get('/pkh/bagikan/{id}',[BantuanPkhController::class,'bagikanBantuan'])->name('pkh.bagikan');
    Route::post('/pkh/verify/{id}',[BantuanPkhController::class,'verifyBantuan'])->name('pkh.verify');
    Route::get('/pkh/verify/{id}',[BantuanPkhController::class,'formVerify'])->name('pkh.form.verify');
    Route::resource('pkh',BantuanPkhController::class);
    // bnpt
    Route::post('/bpnt/konfirmasi/{id}',[BantuanBnptController::class,'konfirmasi'])->name('bpnt.konfirmasi');
    Route::get('/bpnt/bagikan/aksi',[BantuanBnptController::class,'bagikanBantuanAction'])->name('bpnt.bagikan.aksi');
    Route::get('/bpnt/bagikan/{id}',[BantuanBnptController::class,'bagikanBantuan'])->name('bpnt.bagikan');
    Route::post('/bpnt/verify/{id}',[BantuanBnptController::class,'verifyBantuan'])->name('bpnt.verify');
    Route::get('/bpnt/verify/{id}',[BantuanBnptController::class,'formVerify'])->name('bpnt.form.verify');
    Route::resource('bpnt',BantuanBnptController::class);

    // pendaftaran bantuan
    Route::get('/pendaftaran',[PendaftaranController::class,'pendaftaranbnpt'])->name('bnpt.pendaftaran');
    Route::post('/pendaftaran',[PendaftaranController::class,'store'])->name('pendaftaran.store');
});

// laporan
Route::group(['prefix'=>'laporan','middleware'=>'auth'],function(){
    Route::get('pkh',[LaporanPkhController::class,'index'])->name('report.pkh');
    Route::get('bpnt',[LaporanBnptController::class,'index'])->name('report.bpnt');
});
