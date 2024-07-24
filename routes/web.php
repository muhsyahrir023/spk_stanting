<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DepartemenController;

// ADMIN
use App\Http\Controllers\Admin\JabatanController as AdminJabatanController;
use App\Http\Controllers\Admin\GradeController as AdminGradeController;

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
    return view('homepage');
});

Route::get('main',[LayoutController::class,'index'])->middleware('auth');
Route::get('home',[LayoutController::class,'index'])->middleware('auth');

Route::controller(LoginController::class)->group(function(){
    Route::get('login','index')->name('login');
    Route::post('login/proses', 'proses');
    Route::get('logout','logout');
});

Route::group(['middleware' => ['auth']], function(){
    Route::group(['middleware' => ['cekUserLogin:1']],function(){
        Route::get('karyawan', [KaryawanController::class,'index'])->name('karyawan');
        Route::get('karyawan/create', [KaryawanController::class,'create']);
        Route::post('karyawan/store', [KaryawanController::class,'store']);
        Route::get('karyawan/{id}/edit', [KaryawanController::class,'edit'])->name('editkaryawan');
        Route::put('karyawan/{id}', [KaryawanController::class,'update']);
        Route::delete('karyawan/{id}', [KaryawanController::class,'destroy'])->name('karyawan.destroy');

        Route::get('jabatan', [AdminJabatanController::class,'index'])->name('jabatan');
        Route::get('jabatan/create', [AdminJabatanController::class,'create']);
        Route::post('jabatan/store', [AdminJabatanController::class,'store']);
        Route::get('jabatan/{id}/edit', [AdminJabatanController::class,'edit'])->name('editjabatan');
        Route::put('jabatan/{id}', [AdminJabatanController::class,'update']);
        Route::delete('jabatan/{id}', [AdminJabatanController::class,'destroy'])->name('jabatan.destroy');

        Route::get('grade', [AdminGradeController::class,'index'])->name('grade');
        Route::get('grade/create', [AdminGradeController::class,'create']);
        Route::post('grade/store', [AdminGradeController::class,'store']);
        Route::get('grade/{id}/edit', [AdminGradeController::class,'edit'])->name('editgrade');
        Route::put('grade/{id}', [AdminGradeController::class,'update']);
        Route::delete('grade/{id}', [AdminGradeController::class,'destroy'])->name('grade.destroy');
    });
});
