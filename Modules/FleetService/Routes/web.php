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


Route::prefix('fleetservice')->group(function() {
    Route::get('/', 'FleetServiceController@index');
});

Route::prefix('fleets')->group(function(){
    Route::get('/', [\Modules\FleetService\Http\Controllers\Dashboard\DashboardController::class, "viewDashboard"])->name("fleet_dashboard");
    Route::get('all', [Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class,'viewVehicles'])->name("all_fleets");
    Route::get('details', [\Modules\FleetService\Http\Controllers\Fleet\FleetController::class, "viewFleetDetails"])->name("fleet_details");
    Route::get('add', [\Modules\FleetService\Http\Controllers\Fleet\FleetController::class, "addFleet"])->name("add_fleet");
    Route::get('edit/{id}', [\Modules\FleetService\Http\Controllers\Fleet\FleetController::class, "editFleet"])->name("edit_fleet");

    Route::group(['prefix'=>'vehicle/'], function () {
        Route::get('',[Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class,'viewVehicles'])->name("fleet_vehicle");
        Route::get('add/',[Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class,'addVehicle'])->name("fleet_vehicle_add");
        Route::post('add/',[Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class,'storeVehicle'])->name("fleet_vehicle_store");
        Route::get('{vehicle_id}/details/',[Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class,'viewvehicleDetail'])->name("fleet_vehicle_detail");
        Route::get('edit/{id}',[Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class,'editVehicle'])->name("fleet_vehicle_edit");
        Route::get('is-unique-vehicle/',[Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class,'isUniqueVehicle'])->name("fleet_vehicle_is_unique");
        Route::get('get-make-models/',[Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class,'getMakeModels'])->name("fleet_vehicle_get_make_models");


    });
    Route::group(['prefix'=>'vehicle-log/'], function () {

    });
    Route::group(['prefix'=>'vehicle-fuel/'], function () {

    });
    Route::group(['prefix'=>'vehicle-lease/'], function () {

    });
    Route::group(['prefix'=>'vehicle-maintenance/'], function () {

    });
    Route::group(['prefix'=>'driver/'], function () {

    });
    Route::group(['prefix'=>'driver-area/'], function () {

    });
});
