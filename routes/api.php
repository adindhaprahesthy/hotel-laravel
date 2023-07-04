<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User2Controller;
use App\Http\Controllers\TipeKamarController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\DetailPemesananController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

Route::group(['middleware' => ['jwt.verify']], function ()
{
    Route::group(['middleware' => ['api.superadmin']], function()
    {
        Route::delete('/user/{id}', [User2Controller::class, 'delete']);
        Route::delete('/tipe_kamar/{id}', [TipeKamarController::class, 'delete']);
        Route::delete('/kamar/{id}', [KamarController::class, 'delete']);
        Route::delete('/pemesanan/{id}', [PemesananController::class, 'delete']);
        Route::delete('/detail_pemesanan/{id}', [DetailPemesananController::class, 'delete']);
    });

    Route::group(['middleware'=> ['api.admin']], function()
    {
        Route::post('/user', [User2Controller::class, 'store']);
        Route::post('/user/UploadFoto/{id}', [User2Controller::class, 'UploadFoto']);
        Route::put('/user/{id}', [User2Controller::class, 'update']);

        Route::post('/tipe_kamar', [TipeKamarController::class, 'store']);
        Route::post('/tipe_kamar/UploadFotoTipeKamar/{id}', [TipeKamarController::class, 'UploadFotoTipeKamar']);
        Route::put('/tipe_kamar/{id}', [TipeKamarController::class, 'update']);

        Route::post('/kamar', [KamarController::class, 'store']);
        Route::put('/kamar/{id}', [KamarController::class, 'update']);

        Route::post('/pemesanan', [PemesananController::class, 'store']);
        Route::put('/pemesanan/{id}', [PemesananController::class, 'update']);
  
        Route::post('/detail_pemesanan', [DetailPemesananController::class, 'store']);
        Route::put('/detail_pemesanan/{id}', [DetailPemesananController::class, 'update']);

        //Route::post('/storecarttodb', 'TransaksiController@store');
    });

    Route::get('/user', [User2Controller::class, 'show']);
    Route::get('/user/{id}', [User2Controller::class, 'detail']);
    
    Route::get('/tipe_kamar', [TipeKamarController::class, 'show']);
    Route::get('/tipe_kamar/{id}', [TipeKamarController::class, 'detail']);
     
    Route::get('/kamar', [KamarController::class, 'show']);
    Route::get('/kamar/{id}', [KamarController::class, 'detail']);
    Route::put('/kamar/{id}', [KamarController::class, 'update']);
    
    Route::get('/pemesanan', [PemesananController::class, 'show']);
    Route::get('/pemesanan/{id}', [PemesananController::class, 'detail']);
    
    Route::get('/detail_pemesanan', [DetailPemesananController::class, 'show']);
    Route::get('/detail_pemesanan/{id}', [DetailPemesananController::class, 'detail']);

    
});