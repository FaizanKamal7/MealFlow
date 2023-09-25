<?php

use Illuminate\Http\Request;
use Modules\FleetService\Http\Controllers\APIControllers\APIController;
use Modules\FleetService\Http\Controllers\APIControllers\V1\Dashboard\DashboardController;
use Modules\FleetService\Http\Controllers\APIControllers\V1\Vehicle\VehicleController;
use Modules\FleetService\Http\Controllers\APIControllers\V1\VehicleTimeline\VehicleTimelineController;
use Modules\FleetService\Http\Controllers\APIControllers\V1\VehicleFuel\VehicleFuelController;
use Modules\FleetService\Http\Controllers\APIControllers\V1\VehicleMaintenance\VehicleMaintenanceController;
use Modules\FleetService\Http\Controllers\APIControllers\V1\Settings\VehicleModelsController;
use Modules\FleetService\Http\Controllers\APIControllers\V1\Settings\VehicleTypesController;


// Route::middleware('auth:api')->get('/fleetservice', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware' => 'auth:sanctum'], function () {
//     Route::post('/dashboard', [DashboardController::class, 'getDashboardData']);

//     Route::post('/vehicles', [APIController::class, 'getVehicles']);

// });

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'fleet/'], function () {

    Route::get('dashboard', [DashboardController::class, "getDashboardData"]);


    Route::group(['prefix' => 'vehicle/'], function () {
        Route::get('all', [VehicleController::class, 'getVehicles']);
        Route::post('add/', [VehicleController::class, 'storeVehicle'])->name("fleet_vehicle_store");

        Route::get('details/', [VehicleController::class, 'getVehicleDetail']);

        Route::get('{vehicle_id}/edit', [VehicleController::class, 'editVehicle'])->name("fleet_vehicle_edit");
        Route::post('{vehicle_id}/edit', [VehicleController::class, 'updateVehicle'])->name("fleet_vehicle_update");

        Route::get('is-unique-vehicle/', [VehicleController::class, 'isUniqueVehicle'])->name("fleet_vehicle_is_unique");
        Route::get('get-make-models/', [VehicleController::class, 'getMakeModels'])->name("fleet_vehicle_get_make_models");

        Route::delete('{vehicle_id}/delete', [VehicleController::class, 'destroyVehicle'])->name("fleet_vehicle_delete");

        //------------------------------------TIME LINE---------------------------------------------------------------------------
        Route::get('vehicle-timeline/', [VehicleTimelineController::class, 'index'])->name("fleet_vehicle_timeline");


    });
    Route::group(['prefix' => 'logs/'], function () {
        Route::get('fuels', [VehicleFuelController::class, "viewFuelLogs"])->name("fleet_fuel_logs");
        Route::get('maintenance', [VehicleMaintenanceController::class, "viewFleetMaintenance"])->name("fleet_maintenance_logs");
    });
    Route::group(['prefix' => 'settings/'], function () {
        // ------------------------------------------   VEHICLE MODELS URL ------------------------------------------------------------------------------------

        Route::get('models', [VehicleModelsController::class, "getVehicleModels"]);
        Route::get('active_models', [VehicleModelsController::class, "getActiveVehicleModels"]);

        Route::Post('add_models', [VehicleModelsController::class, "storeVehicleModel"])->name("add_vehicle_models");
        Route::post('{vehicle_model}/delete_vehicle_modle', [VehicleModelsController::class, "destroyVehicleModel"])->name("delete_vehicle_model");
        Route::post('{model_id}/update_vehicle_model', [VehicleModelsController::class, "updateVehicleModel"])->name("update_vehicle_model");
        // ------------------------------------------   VEHICLE TYPES URL ------------------------------------------------------------------------------------
        Route::get('types', [VehicleTypesController::class, "viewVehicleTypes"]);
        Route::get('active_types', [VehicleTypesController::class, "getActiveVehicleTypes"])->name("view_vehicle_types");
        Route::post('add_type', [VehicleTypesController::class, "storeVehicleType"])->name("add_vehicle_types");
        Route::post('{type_id}/update_vehicle_type', [VehicleTypesController::class, "updateVehicleType"])->name("update_vehicle_make");
        Route::post('{type_id}/delete_type', [VehicleTypesController::class, "destroyVehicleType"])->name("delete_vehicle_type");


    });

    Route::group(['prefix' => 'drivers/'], function () {
        Route::get('', [Modules\FleetService\Http\Controllers\Driver\DriverController::class, "viewDrivers"])->name("fleet_view_drivers");
        Route::post('add/', [Modules\FleetService\Http\Controllers\Driver\DriverController::class, "storeDriver"])->name("fleet_store_driver");
        Route::get('{driver_id}/driver_timeline', [Modules\FleetService\Http\Controllers\Driver\DriverController::class, "showDriverTimeline"])->name("fleet_view_driver_timeline");
        Route::delete('{driver_id}/delete', [Modules\FleetService\Http\Controllers\Driver\DriverController::class, "delete_driver"])->name("delete_driver");
        Route::get('{driver_id}/details', [Modules\FleetService\Http\Controllers\Driver\DriverController::class, "showDriver"])->name("fleet_view_driver_detail");
        Route::post('{driver_id}/update', [Modules\FleetService\Http\Controllers\Driver\DriverController::class, "updateDriver"])->name("fleet_update_driver_detail");

    });

    Route::group(['prefix' => 'vehicle-lease/'], function () {

    });
    Route::group(['prefix' => 'vehicle-maintenance/'], function () {
        Route::get('/maintenance', [Modules\FleetService\Http\Controllers\VehicleMaintenance\VehicleMaintenanceController::class, "viewFleetMaintenance"])->name("fleet_maintenance");
        Route::post('/store', [Modules\FleetService\Http\Controllers\VehicleMaintenance\VehicleMaintenanceController::class, "storeFleetMaintenance"])->name("store_fleet_maintenance");
        Route::get('/fuel', [Modules\FleetService\Http\Controllers\VehicleFuel\VehicleFuelController::class, "viewFleetFuelList"])->name("fleet_fuel");
        Route::post('/store', [Modules\FleetService\Http\Controllers\VehicleFuel\VehicleFuelController::class, "storeFleetFuel"])->name("store_fleet_fuel");

    });
    Route::group(['prefix' => 'driver-area/'], function () {


    });
});