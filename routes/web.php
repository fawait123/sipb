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

// route agama
Route::group(['prefix'=>'masterdata'],function(){
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
