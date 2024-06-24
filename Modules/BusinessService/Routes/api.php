<?php

use App\Http\Controllers\APIControllers\V1\BusinessInfo\BusinessInfoController;
use Illuminate\Http\Request;

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


Route::group(['middleware' => 'auth:api', 'prefix' => 'businessservice/'], function () {
    Route::GET('get-business-info', [BusinessInfoController::class, "getBusinessInfo"]);
    Route::GET('get-business-customers', [BusinessInfoController::class, "getBusinessCustomers"]);
});
