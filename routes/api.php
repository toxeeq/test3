<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\passportAuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('p1')->name('api.p1.')->namespace('App\Http\Controllers\Api\p1')->group(function() {
    Route::middleware('auth:api')->get('/status', function(){
        return response()->json(['status'=>'OK']);
    })->name('status');

    Route::apiResource('newpanel', 'NewPanelController');
    Route::middleware('auth:api')->apiResource('search', 'SearchController')->only('index');

    Route::post('/login-user', [passportAuthController::class, 'loginUser']);
    Route::post('/register-new-user',[passportAuthController::class, 'newUserRegister']);

    Route::middleware('auth:api')->group(function(){
        Route::get('/get-user', [passportAuthController::class, 'userDetaile']);
    });
});


