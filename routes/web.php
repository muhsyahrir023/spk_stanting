<?php

use App\Http\Controllers\Admin\BalitaController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LayoutController;


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
        Route::get('balita', [BalitaController::class,'index'])->name('balita');
        Route::get('balita/create', [BalitaController::class,'create']);
        Route::post('balita/store', [BalitaController::class,'store']);
        Route::get('balita/{id}/edit', [BalitaController::class,'edit'])->name('editbalita');
        Route::put('balita/{id}', [BalitaController::class,'update']);
        Route::delete('balita/{id}', [BalitaController::class,'destroy'])->name('balita.destroy');

    });
});
