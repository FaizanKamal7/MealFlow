<?php

use App\Http\Controllers\APIControllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware'=>'auth:api'],function (){
    
    Route::post('/logout',[AuthController::class,'logout']);


    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();
});





Route::get('/get-google-api-key', function () {
    return response()->json([
        'google_api_key' => config('services.google.key')
    ]);
});
