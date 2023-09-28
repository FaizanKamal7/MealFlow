<?php

use Illuminate\Http\Request;
use Modules\DeliveryService\Http\Controllers\APIControllers\V1\BagCollection\BagCollectionController;
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
        Route::post('start-batch', [DeliveryBatchController::class, "startDeliveryBatch"]);
        Route::post('end-batch', [DeliveryBatchController::class, "endDeliveryBatch"]);
    
    });
    Route::prefix('deliveries/')->group(function () {
        Route::post('complete-delivery', [DeliveryController::class, "completeDelivery"]);
        Route::post('end-batch', [DeliveryBatchController::class, "endDeliveryBatch"]);
    
    });
    Route::group(['prefix' => 'Bag/'], function () {

        Route::group(['prefix' => 'Collection/'], function () {
            Route::post('create', [BagCollectionController::class, "createBagCollection"]);

        });
    });
 
});