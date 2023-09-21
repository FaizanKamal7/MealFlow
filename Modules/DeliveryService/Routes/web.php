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

use Modules\DeliveryService\Http\Controllers\Customers\CustomersController;

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
    //TODO:: This route will be moved to Customers Module
    Route::get('get-delivery-addresses', [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "getAddresses"])->name("get_customer_address");
    Route::get('/suggested',  [Modules\DeliveryService\Http\Controllers\Deliveries\DeliveryController::class, "get_suggested_driver"] );
    //    });

    Route::group(['prefix' => 'bag/'], function () {
        Route::get('/', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "viewAllBags"])->name("view_all_bags");
        Route::POST('/bags', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "viewBusinessBag"])->name("view_business_bags");
        Route::get('{bag_id}/timeline', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "bagTimeline"])->name("view_bag_timeline");

        Route::get('/add', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "addBag"])->name("add_new_bag");
        Route::post('/add', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "storeBag"])->name("store_new_bag");

        Route::get('/update{bag_id}', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "updateBagStatus"])->name("update_bag_status");
    });
});
