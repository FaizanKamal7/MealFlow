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
    Route::get('/test', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "test"])->name("test");



    // Route::post('upload/test_upload_db', [DeliveryController::class, "testUploadDB"])->name("test_upload_db");
    Route::post('upload/test_upload_db', [DeliveryController::class, "testUploadDBCustomers"])->name("test_upload_db");


    //    Route::group(['prefix'=> 'deliveries'], function (){

    Route::get('upload', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "uploadDeliveries"])->name("upload_deliveries");
    Route::post('upload', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "uploadDeliveriesByForm"])->name("upload_deliveries_by_form");
    Route::get('generate-template', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "generateAndDownloadDeliveryTemplate"])->name("generate_delivery_template");
    Route::post('upload/excel', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "uploadDeliveriesByExcel"])->name("upload_deliveries_by_excel");
    Route::get('/batch', [DeliveryController::class, "batch"])->name("batch");
    Route::get('/update', [DeliveryController::class, "update"])->name("users.update");
    Route::post('/upload-conflicted-deliveries', [DeliveryController::class, "uploadConflictedDeliveries"])->name("upload_conflicted_deliveries");

    // thhese routes are for suggested driver and assigning of delivery    
    Route::get('/unassigned-deliveries',  [DeliveryController::class, "unassignedDeliveries"])->name("unassigned_deliveries");
    Route::POST('/assigning_process',  [DeliveryController::class, "assignDeliveriesToDriver"])->name('assign_delivery_to_driver');
    Route::get('/assigned-deliveries', [DeliveryController::class, "viewAssignedDeliveries"])->name("view_assigned_deliveries");
    Route::get('/completed-deliveries', [DeliveryController::class, "viewCompletedDeliveries"])->name("view_completed_deliveries");

    Route::get('/print-label', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "printLabel"])->name('print-label');
    Route::post('/upload_deliveries_multiple', [DeliveryController::class, "uploadDeliveriesMultiple"])->name("upload_deliveries_multiple");
    Route::get('/get-business-branches/{id}', [DeliveryController::class, "getBusinessBranches"]);




    //TODO:: This route will be moved to Customers Module
    Route::get('get-delivery-addresses', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "getAddresses"])->name("get_customer_address");
    Route::get('upload', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "uploadDeliveries"])->name("upload_deliveries");
    Route::post('upload', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "uploadDeliveriesByForm"])->name("upload_deliveries_by_form");
    Route::get('generate-template', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "generateAndDownloadDeliveryTemplate"])->name("generate_delivery_template");
    Route::get('unassign', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "viewUnassignedDeliveries"])->name("view_unassign");
    Route::get('update-deliveries-label', [DeliveryController::class, "updateDeliveriesLabel"])->name("update_deliveries_label");
    Route::get('deliveries-label/{deliveries}', [DeliveryController::class, "viewDeliveriesLabelView"])->name("view_deliveries_label");
    Route::get('{delivery_id}/timeline', [DeliveryController::class, "deliveryTimeline"])->name("view_delivery_timeline");


    //    });

    Route::group(['prefix' => 'bag/'], function () {
        Route::get('/', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "viewAllBags"])->name("view_all_bags");
        Route::POST('/bags', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "viewBusinessBag"])->name("view_business_bags");
        Route::get('{bag_id}/timeline', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "bagTimeline"])->name("view_bag_timeline");
        Route::get('/add', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "addBag"])->name("add_new_bag");
        Route::post('/add', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "storeBag"])->name("store_new_bag");
        Route::get('/update{bag_id}', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "updateBagStatus"])->name("update_bag_status");
        Route::get('/customer-empty-bags/{customer_id}', [BagsController::class, "getCustomerEmptyBagCollection"])->name("get-customer-empty-bag-collection");

        Route::group(['prefix' => 'pickups/'], function () {
            Route::get('/unassigned-bags-pickup', [BagsController::class, "unassignedBagsPickup"])->name("unassigned_bags_pickup");
            Route::POST('/assign-bag-pickup-to-driver', [BagsController::class, "assignBagsPickup"])->name("assign_bag_pickup_to_driver");
            Route::get('/assigned-bags-pickup', [BagsController::class, "assignedBagsPickup"])->name("assigned_bags_pickup");
            Route::get('/completed-bags-pickup', [BagsController::class, "completedBagsPickup"])->name("completed_bags_pickup");
        });
        Route::group(['prefix' => 'collections/'], function () {
            Route::get('/upload-bags-collection', [BagsController::class, "uploadBagsCollection"])->name("upload_bags_collection");
            Route::POST('/store-bags-collection', [BagsController::class, "storeBagsCollection"])->name("store_bags_collection");
            Route::get('/unassigned-bags-collection', [BagsController::class, "unassignedBagsCollection"])->name("unassigned_bags_collection");
            Route::POST('/assign-bag-collection-to-driver', [BagsController::class, "assignBagsCollection"])->name("assign_bag_collection_to_driver");
            Route::get('/assigned-bags-collection', [BagsController::class, "assignedBagsCollection"])->name("assigned_bags_collection");
            Route::get('/completed-bags-collection', [BagsController::class, "completedBagsCollection"])->name("completed_bags_collection");
            Route::get('/cancelled-bags-collection', [BagsController::class, "cancelledBagsCollection"])->name("cancelled_bags_collection");
            Route::get('/deleted-bags-collection', [BagsController::class, "deletedBagsCollection"])->name("deleted_bags_collection");



            // Route::GET('/d\river-bag-collection', [BagsController::class, "assignBagsCollection"])->name("assign_bag_collection_to_driver");
        });
    });

    Route::group(['prefix' => 'meal/'], function () {
        Route::get('add-customer-to-plan', [DeliveryController::class, "addCustomerToPlanView"])->name("add_customer_to_plan_view");
        Route::get('view-plan', [DeliveryController::class, "viewMealPlan"])->name("view_plan_delivery");
        Route::post('add_plan', [DeliveryController::class, "addMealPlan"])->name("add_plan_delivery");
        Route::post('upload_plan', [DeliveryController::class, "uploadMealPlan"])->name("upload_plan_delivery");
        Route::get('customer-meal-plans/{customer_id}', [DeliveryController::class, "getCustomersMealPlan"])->name("get_customer_meal_plans");
    });
});
