<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\IncomingController;
use App\Http\Controllers\OutgoingController;

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

//  Dashboard
//  **
Route::get('/', [DashboardController::class, 'index']);

//  Login
//  **
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login/postlogin', [LoginController::class, 'postlogin']);

//  Admin
//  **
Route::get('/home', [HomeController::class, 'index'])->middleware('sesauthgitinventory');

//  **
//  Pemasukkan
Route::get('/input', [IncomingController::class,'index'])->middleware('sesauthgitinventory');
Route::get('/input/loaddata', [IncomingController::class,'loaddata'])->middleware('sesauthgitinventory')->name('input.loaddata');
Route::get('/input/pagination', [IncomingController::class,'pagination'])->middleware('sesauthgitinventory')->name('input.pagination');
Route::get('/input/download', [IncomingController::class,'download'])->middleware('sesauthgitinventory')->name('input.download');

//  **
//  Pengeluaran
Route::get('/output', [OutgoingController::class,'index'])->middleware('sesauthgitinventory');
Route::get('/output/loaddata', [OutgoingController::class,'loaddata'])->middleware('sesauthgitinventory')->name('output.loaddata');
Route::get('/output/pagination', [OutgoingController::class,'pagination'])->middleware('sesauthgitinventory')->name('output.pagination');
Route::get('/output/download', [OutgoingController::class,'download'])->middleware('sesauthgitinventory')->name('output.download');
