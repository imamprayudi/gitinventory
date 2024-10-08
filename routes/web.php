<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\IncomingController;
use App\Http\Controllers\OutgoingController;
use App\Http\Controllers\WipController;
use App\Http\Controllers\MutationController;
use App\Http\Controllers\OpnameController;

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

Route::group(['middleware'=>['sesauthgitinventory']], function () {

    //  Admin
    //  **
    Route::get('/home', [HomeController::class, 'index']);

    Route::prefix('/input')->group(function () {
        //  **
        //  Pemasukkan
        Route::get('/', [IncomingController::class,'index']);
        Route::get('/loaddata', [IncomingController::class,'loaddata'])->name('input.loaddata');
        Route::get('/pagination', [IncomingController::class,'pagination'])->name('input.pagination');
        Route::get('/download', [IncomingController::class,'download'])->name('input.download');
    });
    
    Route::prefix('/output')->group(function(){

        //  **
        //  Pengeluaran
        Route::get('/', [OutgoingController::class,'index']);
        Route::get('/loaddata', [OutgoingController::class,'loaddata'])->name('output.loaddata');
        Route::get('/pagination', [OutgoingController::class,'pagination'])->name('output.pagination');
        Route::get('/download', [OutgoingController::class,'download'])->name('output.download');

    });

    //  **
    //  Mutation
    Route::get('/bahan_baku_gm', [MutationController::class, 'gudang_material']);
    Route::get('/bahan_baku_gu', [MutationController::class, 'gudang_umum']);
    Route::get('/bahan_penolong', [MutationController::class, 'bahan_penolong']);
    Route::get('/mesin', [MutationController::class, 'mesin']);
    Route::get('/sparepart', [MutationController::class, 'sparepart']);
    Route::get('/mold', [MutationController::class, 'mold']);
    Route::get('/peralatan_pabrik', [MutationController::class, 'peralatan_pabrik']);
    Route::get('/konstruksi', [MutationController::class, 'konstruksi']);
    Route::get('/kantor', [MutationController::class, 'kantor']);
    Route::get('/finishgood_gfg', [MutationController::class, 'finishgood_gfg']);
    Route::get('/finishgood_gu', [MutationController::class, 'finishgood_gu']);
    Route::get('/pengemas', [MutationController::class, 'pengemas']);
    Route::get('/bahan_baku_contoh', [MutationController::class, 'bahan_baku_contoh']);
    Route::get('/finishgood_contoh', [MutationController::class, 'finishgood_contoh']);
    Route::get('/service', [MutationController::class, 'service']);
    Route::get('/scrap', [MutationController::class, 'scrap']);

    // Route::get('/sparepart', [SparepartController::class, 'index']);

    Route::get('/mutation', [MutationController::class,'loaddata'])->name('mutation');
    Route::get('/mutation-pagination', [MutationController::class,'pagination'])->name('mutation_page');
    Route::get('/mutation-download', [MutationController::class,'download'])->name('mutation-download');

    Route::get('/wip', [WipController::class,'index'])->name('wip');
    Route::get('/wip_loaddata', [WipController::class,'loaddata'])->name('wip_loaddata');
    Route::get('/wip_pagination', [WipController::class,'pagination'])->name('wip_pagination');
    Route::get('/wip_download', [WipController::class,'download'])->name('wip_download');

    //  **
    //  Stock opname
    Route::get('/opname-bahan_baku_gm', [OpnameController::class, 'gudang_material']);
    Route::get('/opname-bahan_baku_gu', [OpnameController::class, 'gudang_umum']);
    Route::get('/opname-bahan_penolong', [OpnameController::class, 'bahan_penolong']);
    Route::get('/opname-mesin', [OpnameController::class, 'mesin']);
    Route::get('/opname-sparepart', [OpnameController::class, 'sparepart']);
    Route::get('/opname-mold', [OpnameController::class, 'mold']);
    Route::get('/opname-peralatan_pabrik', [OpnameController::class, 'peralatan_pabrik']);
    Route::get('/opname-konstruksi', [OpnameController::class, 'konstruksi']);
    Route::get('/opname-kantor', [OpnameController::class, 'kantor']);
    Route::get('/opname-finishgood_gfg', [OpnameController::class, 'finishgood_gfg']);
    Route::get('/opname-finishgood_gu', [OpnameController::class, 'finishgood_gu']);
    Route::get('/opname-pengemas', [OpnameController::class, 'pengemas']);
    Route::get('/opname-bahan_baku_contoh', [OpnameController::class, 'bahan_baku_contoh']);
    Route::get('/opname-finishgood_contoh', [OpnameController::class, 'finishgood_contoh']);
    Route::get('/opname-service', [OpnameController::class, 'service']);
    Route::get('/opname-scrap', [OpnameController::class, 'scrap']);

    Route::get('/opname-loaddata', [OpnameController::class,'loaddata'])->name('opname-loaddata');
    Route::get('/opname-pagination', [OpnameController::class,'pagination'])->name('opname-pagination');
    Route::get('/opname-download', [OpnameController::class,'download'])->name('opname-download');
    Route::post('/opname-upload-file', [OpnameController::class, 'store'])->name('opname-upload-post');


    
});





















// Route::get('/bahan_baku/loaddata', [BahanBakuController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('bahan_baku.loaddata');

// //  **
// //  Finished Goods
// Route::get('/finishgood/loaddata', [FinishgoodController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('finishgood.loaddata');
// Route::get('/finishgood/pagination', [FinishgoodController::class, 'pagination'])->middleware('sesauthgitinventory')->name('finishgood.pagination');
// Route::get('/finishgood/download', [FinishgoodController::class, 'download'])->middleware('sesauthgitinventory')->name('finishgood.download');

// //  **
// //  Service Parts
// Route::get('/service/loaddata', [ServiceController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('service.loaddata');

// //  **
// //  WIP
// Route::get('/wip/loaddata', [WipController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('wip.loaddata');

// //  **
// //  Bahan Baku - Contoh
// Route::get('/bahan_baku_contoh/loaddata', [BahanBakuContohController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('bahan_baku_contoh.loaddata');

// //  **
// //  Finished Goods Contoh
// Route::get('/finishgood_contoh/loaddata', [FinishgoodContohController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('finishgood_contoh.loaddata');
// Route::get('/finishgood_contoh/pagination', [FinishgoodContohController::class, 'pagination'])->middleware('sesauthgitinventory')->name('finishgood_contoh.pagination');
// Route::get('/finishgood_contoh/download', [FinishgoodContohController::class, 'download'])->middleware('sesauthgitinventory')->name('finishgood_contoh.download');

// //  **
// //  Bahan Penolong
// Route::get('/bahan_penolong/loaddata', [BahanPenolongController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('bahan_penolong.loaddata');

// //  **
// //  Bahan Pengemas
// Route::get('/pengemas/loaddata', [PengemasController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('pengemas.loaddata');

// //  **
// //  Barang Modal Mesin






// //  **
// //  Barang Modal Sparepart

// //  **
// //  Barang Modal Peralatan Pabrik

// //  **
// //  Barang Modal Mold / Tooling

// //  **
// //  Barang Modal Peralatan Konstruksi

// //  **
// //  Peralatan Kantor


// //  **
// //  Scrap
// Route::get('/scrap/loaddata', [ScrapController::class, 'loaddata'])->middleware('sesauthgitinventory')->name('scrap.loaddata');
// Route::get('/scrap/pagination', [ScrapController::class, 'pagination'])->middleware('sesauthgitinventory')->name('scrap.pagination');
// Route::get('/scrap/download', [ScrapController::class, 'download'])->middleware('sesauthgitinventory')->name('scrap.download');










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

