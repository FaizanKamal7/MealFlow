<?php

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

use Modules\DeliveryService\Http\Controllers\Bags\BagsController;
use Modules\DeliveryService\Http\Controllers\Customers\CustomersController;
use Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController;

Route::prefix('admin/deliveries')->group(function () {
    Route::get('download-excel', 'DeliveryServiceController@downloadExcel');
    //    Route::get('/upload', 'DeliveryServiceController@uploadDeliveryView');
    Route::post('/upload/bulk', 'DeliveryServiceController@addBulk')->name("bulk_delivery_add");
    Route::get('/upload/bulk', 'DeliveryServiceController@bulkAddView')->name("bulk_delivery_add_view");
    Route::post('/upload/save', 'DeliveryServiceController@uploadFile')->name("upload_file");
    Route::get('/', 'DeliveryServiceController@index');



    //    Route::group(['prefix'=> 'deliveries'], function (){

    Route::get('upload', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "uploadDeliveries"])->name("upload_deliveries");
    Route::post('upload', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "uploadDeliveriesByForm"])->name("upload_deliveries_by_form");
    Route::get('generate-template', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "generateAndDownloadDeliveryTemplate"])->name("generate_delivery_template");
    Route::post('upload/excel', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "uploadDeliveriesByExcel"])->name("upload_deliveries_by_excel");
    Route::get('upload/excel', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "uploadDeliveriesByExcel"])->name("upload_deliveries_by_excel");
    Route::get('/batch', [DeliveryController::class, "batch"])->name("batch");
    Route::get('/update', [DeliveryController::class, "update"])->name("users.update");
    Route::post('/upload-conflicted-deliveries', [DeliveryController::class, "uploadConflictedDeliveries"])->name("upload_conflicted_deliveries");

    // thhese routes are for suggested driver and assigning of delivery    
    Route::get('/unassigned-deliveries', [DeliveryController::class, "unassignedDeliveries"])->name("unassigned_deliveries");
    Route::POST('/assigning_process', [DeliveryController::class, "assignDeliveriesToDriver"])->name('assigned_delivery_to_driver');
    Route::get('/assigned-deliveries', [DeliveryController::class, "viewAssignedDeliveries"])->name("view_assigned_deliveries");
    Route::get('/completed-deliveries', [DeliveryController::class, "viewCompletedDeliveries"])->name("view_completed_deliveries");

    Route::get('/print-label', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "printLabel"])->name('print-label');
    Route::post('/upload_deliveries_multiple', [DeliveryController::class, "UploadDeliveriesMultiple"])->name("upload_deliveries_multiple");
    // routes/web.php
    Route::get('/get-business-branches/{id}', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "getBusinessBranches"]);




    //TODO:: This route will be moved to Customers Module
    Route::get('get-delivery-addresses', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "getAddresses"])->name("get_customer_address");
    Route::get('upload', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "uploadDeliveries"])->name("upload_deliveries");
    Route::post('upload', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "uploadDeliveriesByForm"])->name("upload_deliveries_by_form");
    Route::get('generate-template', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "generateAndDownloadDeliveryTemplate"])->name("generate_delivery_template");
    Route::post('upload/excel', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "uploadDeliveriesByExcel"])->name("upload_deliveries_by_excel");
    Route::get('unassign', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "viewUnassignedDeliveries"])->name("view_unassign");
    Route::get('update-deliveries-label', [DeliveryController::class, "updateDeliveriesLabel"])->name("update_deliveries_label");
    Route::get('deliveries-label/{deliveries}', [DeliveryController::class, "viewDeliveriesLabelView"])->name("view_deliveries_label");


    //    });

    Route::group(['prefix' => 'bag/'], function () {
        Route::get('/', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "viewAllBags"])->name("view_all_bags");
        Route::POST('/bags', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "viewBusinessBag"])->name("view_business_bags");
        Route::get('{bag_id}/timeline', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "bagTimeline"])->name("view_bag_timeline");

        Route::get('/add', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "addBag"])->name("add_new_bag");
        Route::post('/add', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "storeBag"])->name("store_new_bag");

        Route::get('/update{bag_id}', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "updateBagStatus"])->name("update_bag_status");
        Route::get('/unassigned-bags-pickup', [BagsController::class, "unassignedBagsPickup"])->name("unassigned_bags_pickup");
        Route::POST('/assign-bag-pickup-to-driver', [BagsController::class, "assignBagsPickup"])->name("assign_bag_pickup_to_driver");
        Route::get('/assigned-bags-pickup', [BagsController::class, "assignedBagsPickup"])->name("assigned_bags_pickup");

        // Route::GET('/driver-bag-pickup', [BagsController::class, "assignBagsPickup"])->name("assign_bag_pickup_to_driver");
    });

});