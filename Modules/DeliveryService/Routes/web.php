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
    Route::get('download-excel', 'DeliveryServiceController@downloadExcel');
    Route::get('/upload', 'DeliveryServiceController@uploadDeliveryView');
    Route::post('/upload/save', 'DeliveryServiceController@uploadFile')->name("upload_file");
    Route::get('/', 'DeliveryServiceController@index');
    Route::get('/bag', [Modules\DeliveryService\Http\Controllers\Bags\BagsController::class, "storeBag"])->name("add_new_bag");
});
