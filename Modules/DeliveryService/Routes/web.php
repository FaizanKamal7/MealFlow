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

Route::prefix('delivery')->group(function() {
    Route::get('/', 'DeliveryServiceController@index');

    Route::group(['prefix' => 'bag/'], function () {
        Route::get('/', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "viewAllBags"])->name("view_all_bags");
        Route::get('/bags', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "viewPartnerBag"])->name("view_partner_bags");

        Route::get('/add', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "addBag"])->name("add_new_bag");
        Route::post('/add/{partner_id}', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "storeBag"])->name("store_new_bag");

    });

    
});
