<?php

use Illuminate\Http\Request;
use Modules\DeliveryService\Http\Controllers\APIControllers\V1\BagCollection\BagCollectionController;
use Modules\DeliveryService\Http\Controllers\APIControllers\V1\Bags\BagsController;
use Modules\DeliveryService\Http\Controllers\APIControllers\V1\Deliveries\DeliveryController;
use Modules\DeliveryService\Http\Controllers\APIControllers\V1\DeliveryBatch\DeliveryBatchController;
use Modules\DeliveryService\Http\Controllers\APIControllers\V1\EmptyBagCollection\EmptyBagCollectionController;

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

Route::group(['prefix' => 'deliveryservice/'], function () {

    Route::prefix('driver/')->group(function () {
        Route::GET('deliveries', [DeliveryController::class, "getDriverDeliveries"]);
    });

    Route::prefix('deliverybatch/')->group(function () {
        // Route::POST('start-batch', [DeliveryBatchController::class, "startDeliveryBatch"]);
        // Route::POST('end-batch', [DeliveryBatchController::class, "endDeliveryBatch"]);
        Route::POST('update-delivery-batch-progress', [DeliveryBatchController::class, "updateDeliveryBatchpProgress"]);
    });

    Route::prefix('deliveries/')->group(function () {
        Route::GET('download-deliveries_excel-sample', [DeliveryController::class, "generateAndDownloadDeliveryTemplate"]);

        Route::post('upload/excel', [DeliveryController::class, "uploadDeliveriesByExcel"]);
        Route::post('upload/single-delivery', [DeliveryController::class, "uploadSingleDelivery"]);

        Route::POST('complete-delivery', [DeliveryController::class, "completeDelivery"]);
        Route::POST('end-batch', [DeliveryBatchController::class, "endDeliveryBatch"]);

        Route::DELETE('delete-delivery', [DeliveryBatchController::class, "deleteDelivery"]);
        Route::GET('get-business-customers', [DeliveryController::class, "getBusinessCustomer"]);
        Route::GET('get-delivery-slots', [DeliveryController::class, "getDeliverySlots"]);
    });

    // Route::group(['prefix' => 'Collection/'], function () {
    //     Route::POST('create', [BagCollectionController::class, "createBagCollection"]);
    // });

    // Route::group(['prefix' => 'Pickup/'], function () {
    //     Route::GET('driver-bags-pickup', [BagsController::class, "driverBagsPickup"]);
    // });

    Route::group(['prefix' => 'bag/'], function () {

        Route::group(['prefix' => 'collection/'], function () {
            Route::POST('create', [EmptyBagCollectionController::class, "createBagCollectionAtDelivery"]);
            Route::POST('create-delivery-bag-collection', [EmptyBagCollectionController::class, "createBagCollectionAtDelivery"]);
            Route::POST('update-bag-collection-batch-progress', [EmptyBagCollectionController::class, "updateBagCollectionBatchpProgress"]);
        });

        Route::group(['prefix' => 'pickup/'], function () {
            Route::GET('driver-assigned-pickup', [DeliveryController::class, "driverAssignedPickup"]);
            Route::GET('driver-pending-pickups', [DeliveryController::class, "driverPendingPickups"]);
            Route::GET('driver-completed-pickups', [DeliveryController::class, "driverCompletedPickups"]);
            Route::POST('link-bag-with-delivery', [DeliveryController::class, "linkBagWithDelivery"]);
            Route::POST('update-pickup-batch-progress', [DeliveryController::class, "updatePickupBatchpProgress"]);
        });
    });
});
