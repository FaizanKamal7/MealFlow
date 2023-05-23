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
    Route::get('all', [\Modules\FleetService\Http\Controllers\Fleet\FleetController::class, "viewFleets"])->name("all_fleets");
    Route::get('details', [\Modules\FleetService\Http\Controllers\Fleet\FleetController::class, "viewFleetDetails"])->name("fleet_details");
    Route::get('add', [\Modules\FleetService\Http\Controllers\Fleet\FleetController::class, "addFleet"])->name("add_fleet");
    Route::get('edit/{id}', [\Modules\FleetService\Http\Controllers\Fleet\FleetController::class, "editFleet"])->name("edit_fleet");

    Route::group(['prefix'=>'vehicle/'], function () {
        Route::get('',[Modules\FleetService\Http\Controllers\VehicleController::class,'viewVehicles'])->name("fleet_vehicles");
        Route::get('add/',[Modules\FleetService\Http\Controllers\VehicleController::class,'addVehicles'])->name("fleet_vehicles_add");
        Route::get('add/',[Modules\FleetService\Http\Controllers\VehicleController::class,'storeVehicles'])->name("fleet_vehicles_store");
        Route::get('edit/{id}',[Modules\FleetService\Http\Controllers\VehicleController::class,'editVehicles'])->name("fleet_vehicles_edit");

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
