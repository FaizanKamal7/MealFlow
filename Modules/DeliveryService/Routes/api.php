<?php

use Illuminate\Http\Request;
use Modules\DeliveryService\Http\Controllers\APIControllers\V1\Deliveries\DeliveryController;
use Modules\DeliveryService\Http\Controllers\APIControllers\V1\DeliveryBatch\DeliveryBatchController;

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

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'deliveryservice/'], function () {

    Route::prefix('driver/')->group(function () {
        Route::get('deliveries', [DeliveryController::class, "getDriverDeliveries"]);
    
    });
    Route::prefix('deliverybatch/')->group(function () {
        Route::get('start-batch', [DeliveryBatchController::class, "startDeliveryBatch"]);
    
    });
 
});