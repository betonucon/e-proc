<?php

use Illuminate\Support\Facades\Route;
use App\Events\KirimCreated;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\RegController; 

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
Route::get('/cache-clear', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Cache facade value cleared</h1>';
});
Auth::routes();
Route::get('/testevent', function () {
    KirimCreated::dispatch('sasaaass');
    
    echo 'test broadcast event sangcahaya.id';
});

Route::get('/pendaftaran', [RegController::class, 'index']);
Route::get('/pendaftaran/rekanan', [RegController::class, 'rekanan']);
Route::post('/pendaftaran/store_rekanan', [RegController::class, 'store_rekanan']);
Route::group(['middleware'    => 'auth'],function(){
    
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index']);

    Route::group(['prefix' => 'vendors'],function(){
        Route::get('/', [VendorController::class, 'vendor']);
        Route::get('/pengajuan', [VendorController::class, 'index']);
        Route::get('/create', [VendorController::class, 'create']);
        Route::get('/get_data', [VendorController::class, 'get_data']);
        Route::get('/get_data_rekanan', [VendorController::class, 'get_data_rekanan']);
        Route::get('/view', [VendorController::class, 'view']);
        Route::get('/delete_rekening', [VendorController::class, 'delete_rekening']);
        Route::get('/delete_komoditi', [VendorController::class, 'delete_komoditi']);
        Route::get('/delete_personil', [VendorController::class, 'delete_personil']);
        Route::post('/store', [VendorController::class, 'store']);
        Route::post('/store_bank', [VendorController::class, 'store_bank']);
        Route::post('/store_komoditi', [VendorController::class, 'store_komoditi']);
        Route::post('/store_dokumen', [VendorController::class, 'store_dokumen']);
        Route::post('/store_personil', [VendorController::class, 'store_personil']);
        Route::post('/store_lanjut_komoditi', [VendorController::class, 'store_lanjut_komoditi']);
        Route::post('/store_lanjut_personil', [VendorController::class, 'store_lanjut_personil']);
        Route::post('/store_lanjut_dokumen', [VendorController::class, 'store_lanjut_dokumen']);
        Route::post('/store_lanjut_terima', [VendorController::class, 'store_lanjut_terima']);
        Route::post('/store_lanjut_rekening', [VendorController::class, 'store_lanjut_rekening']);
        Route::post('/store_lanjut_kirim', [VendorController::class, 'store_lanjut_kirim']);
        Route::post('/store_undangan', [VendorController::class, 'store_undangan']);
        Route::post('/store_verifikasi', [VendorController::class, 'store_verifikasi']);
        Route::post('/store_verifikasi_create', [VendorController::class, 'store_verifikasi_create']);
        Route::post('/store_create', [VendorController::class, 'store_create']);
        Route::get('/create_rekening', [VendorController::class, 'create_rekening']);
        Route::get('/create_dokumen', [VendorController::class, 'create_dokumen']);
        Route::get('/create_komoditi', [VendorController::class, 'create_komoditi']);
        Route::get('/create_personil', [VendorController::class, 'create_personil']);
        Route::get('/show_rekening', [VendorController::class, 'show_rekening']);
        Route::get('/show_dashboard', [VendorController::class, 'show_dashboard']);
        Route::get('/show_dashboard_rekanan', [VendorController::class, 'show_dashboard_rekanan']);
        Route::get('/show_dokumen', [VendorController::class, 'show_dokumen']);
        Route::get('/show_komoditi', [VendorController::class, 'show_komoditi']);
        Route::get('/show_personil', [VendorController::class, 'show_personil']);
        


    });

    Route::group(['prefix' => 'master'],function(){
        Route::get('/komoditi', [MasterController::class, 'index_komoditi']);
        Route::get('/komoditi/get_data', [MasterController::class, 'get_data_komoditi']);
        Route::get('/komoditi/view', [MasterController::class, 'view_komoditi']);
        Route::get('/komoditi/delete', [MasterController::class, 'delete_komoditi']);
        Route::post('/komoditi/store', [MasterController::class, 'store_komoditi']);
        
    });

   

});
