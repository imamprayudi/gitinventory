<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\IncomingController;
use App\Http\Controllers\OutgoingController;
use App\Http\Controllers\GudangumumController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\FinishgoodController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ScrapController;
use App\Http\Controllers\WipController;
use App\Http\Controllers\Bahan_BakuController;
use App\Http\Controllers\MesinController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BahanBakuContohController;
use App\Http\Controllers\FinishgoodContohController;
use App\Http\Controllers\BahanPenolongController;
use App\Http\Controllers\PengemasController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\PeralatanPabrikController;
use App\Http\Controllers\MoldController;
use App\Http\Controllers\KonstruksiController;
use App\Http\Controllers\KantorController;

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

//  **
//  Bahan Baku
Route::get('/bahan_baku', [Bahan_BakuController::class, 'index'])->middleware('sesauthgitinventory');
Route::get('/bahan_baku/loaddata', [Bahan_BakuController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('bahan_baku.loaddata');

//  **
//  Finished Goods
Route::get('/finishgood', [FinishgoodController::class, 'index'])->middleware('sesauthgitinventory');
Route::get('/finishgood/loaddata', [FinishgoodController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('finishgood.loaddata');
Route::get('/finishgood/pagination', [FinishgoodController::class, 'pagination'])->middleware('sesauthgitinventory')->name('finishgood.pagination');
Route::get('/finishgood/download', [FinishgoodController::class, 'download'])->middleware('sesauthgitinventory')->name('finishgood.download');

//  **
//  Service Parts
Route::get('/service', [ServiceController::class, 'index'])->middleware('sesauthgitinventory');
Route::get('/service/loaddata', [ServiceController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('service.loaddata');

//  **
//  WIP
Route::get('/wip', [WipController::class, 'index'])->middleware('sesauthgitinventory');
Route::get('/wip/loaddata', [WipController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('wip.loaddata');

//  **
//  Bahan Baku - Contoh
Route::get('/bahan_baku_contoh', [BahanBakuContohController::class, 'index'])->middleware('sesauthgitinventory');
Route::get('/bahan_baku_contoh/loaddata', [BahanBakuContohController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('bahan_baku_contoh.loaddata');

//  **
//  Finished Goods Contoh
Route::get('/finishgood_contoh', [FinishgoodContohController::class, 'index'])->middleware('sesauthgitinventory');
Route::get('/finishgood_contoh/loaddata', [FinishgoodContohController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('finishgood_contoh.loaddata');
Route::get('/finishgood_contoh/pagination', [FinishgoodContohController::class, 'pagination'])->middleware('sesauthgitinventory')->name('finishgood_contoh.pagination');
Route::get('/finishgood_contoh/download', [FinishgoodContohController::class, 'download'])->middleware('sesauthgitinventory')->name('finishgood_contoh.download');

//  **
//  Bahan Penolong
Route::get('/bahan_penolong', [BahanPenolongController::class, 'index'])->middleware('sesauthgitinventory');
Route::get('/bahan_penolong/loaddata', [BahanPenolongController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('bahan_penolong.loaddata');

//  **
//  Bahan Pengemas
Route::get('/pengemas', [PengemasController::class, 'index'])->middleware('sesauthgitinventory');
Route::get('/pengemas/loaddata', [PengemasController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('pengemas.loaddata');

//  **
//  Barang Modal Mesin
Route::get('/mesin', [MesinController::class, 'index'])->middleware('sesauthgitinventory');

//  **
//  Barang Modal Sparepart
Route::get('/sparepart', [SparepartController::class, 'index'])->middleware('sesauthgitinventory');

//  **
//  Barang Modal Peralatan Pabrik
Route::get('/peralatan_pabrik', [PeralatanPabrikController::class, 'index'])->middleware('sesauthgitinventory');

//  **
//  Barang Modal Mold / Tooling
Route::get('/mold', [MoldController::class, 'index'])->middleware('sesauthgitinventory');

//  **
//  Barang Modal Peralatan Konstruksi
Route::get('/konstruksi', [KonstruksiController::class, 'index'])->middleware('sesauthgitinventory');

//  **
//  Peralatan Kantor
Route::get('/kantor', [KantorController::class, 'index'])->middleware('sesauthgitinventory');


//  **
//  Scrap
Route::get('/scrap', [ScrapController::class, 'index'])->middleware('sesauthgitinventory');
Route::get('/scrap/loaddata', [ScrapController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('scrap.loaddata');
Route::get('/scrap/pagination', [ScrapController::class, 'pagination'])->middleware('sesauthgitinventory')->name('scrap.pagination');
Route::get('/scrap/download', [ScrapController::class, 'download'])->middleware('sesauthgitinventory')->name('scrap.download');










//  **
//  Material
// Route::get('/material', [MaterialController::class,'index'])->middleware('sesauthgitinventory');
// Route::get('/material/loaddata', [MaterialController::class,'loaddata'])->middleware('sesauthgitinventory')->name('material.loaddata');
// Route::get('/material/pagination', [MaterialController::class,'pagination'])->middleware('sesauthgitinventory')->name('material.pagination');
// Route::get('/material/download', [MaterialController::class,'download'])->middleware('sesauthgitinventory')->name('material.download');

// //  **
// //  Gudangumum
// Route::get('/gudangumum', [GudangumumController::class,'index'])->middleware('sesauthgitinventory');
// Route::get('/gudangumum/loaddata', [GudangumumController::class,'loaddata'])->middleware('sesauthgitinventory')->name('gudangumum.loaddata');
// Route::get('/gudangumum/pagination', [GudangumumController::class,'pagination'])->middleware('sesauthgitinventory')->name('gudangumum.pagination');
// Route::get('/gudangumum/download', [GudangumumController::class,'download'])->middleware('sesauthgitinventory')->name('gudangumum.download');
// //  **
// //  Finishgood
// Route::get('/finishgood', [FinishgoodController::class,'index'])->middleware('sesauthgitinventory');
// Route::get('/finishgood/loaddata', [FinishgoodController::class,'loaddata'])->middleware('sesauthgitinventory')->name('finishgood.loaddata');
// Route::get('/finishgood/pagination', [FinishgoodController::class,'pagination'])->middleware('sesauthgitinventory')->name('finishgood.pagination');
// Route::get('/finishgood/download', [FinishgoodController::class,'download'])->middleware('sesauthgitinventory')->name('finishgood.download');
// //  **
// //  Production
// Route::get('/production', [ProductionController::class,'index'])->middleware('sesauthgitinventory');
// Route::get('/production/loaddata', [ProductionController::class,'loaddata'])->middleware('sesauthgitinventory')->name('production.loaddata');
// Route::get('/production/pagination', [ProductionController::class,'pagination'])->middleware('sesauthgitinventory')->name('production.pagination');
// Route::get('/production/download', [ProductionController::class,'download'])->middleware('sesauthgitinventory')->name('production.download');

