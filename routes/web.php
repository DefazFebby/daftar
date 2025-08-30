<?php

use App\Http\Controllers\PegawaiController;
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
    return view('welcome');
});

Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai');
Route::get('/tambahpegawai', [PegawaiController::class, 'tambahpegawai'])->name('tambahpegawai');
Route::post('/insertpegawai', [PegawaiController::class, 'insertpegawai'])->name('insertpegawai');
Route::get('/pegawai/{id}', [PegawaiController::class, 'tampilpegawai'])->name('tampilpegawai');
Route::post('/pegawai/{id}', [PegawaiController::class, 'updatepegawai'])->name('updatepegawai');
Route::delete('/pegawai/{id}', [PegawaiController::class, 'deletepegawai'])->name('deletepegawai');
Route::get('/exportpdf', [PegawaiController::class, 'exportpdf'])->name('exportpdf');
Route::get('/exportexcel', [PegawaiController::class, 'exportexcel'])->name('exportexcel');
Route::post('/importexcel', [PegawaiController::class, 'importexcel'])->name('importexcel');



