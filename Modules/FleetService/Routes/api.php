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

Route::group(['middleware' => 'auth', 'prefix' => 'fleet/'], function () {

    Route::get('dashboard', [DashboardController::class, "getDashboardData"]);


    Route::group(['prefix' => 'vehicle/'], function () {
        Route::get('all', [VehicleController::class, 'getVehicles']);
        Route::post('add/', [VehicleController::class, 'storeVehicle']);

        Route::get('details/', [VehicleController::class, 'getVehicleDetail']);

        Route::get('{vehicle_id}/edit', [VehicleController::class, 'editVehicle']);
        Route::post('{vehicle_id}/edit', [VehicleController::class, 'updateVehicle']);

        Route::get('is-unique-vehicle/', [VehicleController::class, 'isUniqueVehicle']);
        Route::get('get-make-models/', [VehicleController::class, 'getMakeModels']);

        Route::delete('{vehicle_id}/delete', [VehicleController::class, 'destroyVehicle']);

        //------------------------------------TIME LINE---------------------------------------------------------------------------
        Route::get('vehicle-timeline/', [VehicleTimelineController::class, 'index']);
    });
    Route::group(['prefix' => 'logs/'], function () {
        Route::get('fuels', [VehicleFuelController::class, "viewFuelLogs"]);
        Route::get('maintenance', [VehicleMaintenanceController::class, "viewFleetMaintenance"]);
    });
    Route::group(['prefix' => 'settings/'], function () {
        // ------------------------------------------   VEHICLE MODELS URL ------------------------------------------------------------------------------------

        Route::get('models', [VehicleModelsController::class, "getVehicleModels"]);
        Route::get('active_models', [VehicleModelsController::class, "getActiveVehicleModels"]);

        Route::Post('add_models', [VehicleModelsController::class, "storeVehicleModel"]);
        Route::post('{vehicle_model}/delete_vehicle_modle', [VehicleModelsController::class, "destroyVehicleModel"]);
        Route::post('{model_id}/update_vehicle_model', [VehicleModelsController::class, "updateVehicleModel"]);
        // ------------------------------------------   VEHICLE TYPES URL ------------------------------------------------------------------------------------
        Route::get('types', [VehicleTypesController::class, "viewVehicleTypes"]);
        Route::get('active_types', [VehicleTypesController::class, "getActiveVehicleTypes"]);
        Route::post('add_type', [VehicleTypesController::class, "storeVehicleType"]);
        Route::post('{type_id}/update_vehicle_type', [VehicleTypesController::class, "updateVehicleType"]);
        Route::post('{type_id}/delete_type', [VehicleTypesController::class, "destroyVehicleType"]);
    });

    Route::group(['prefix' => 'drivers/'], function () {
        Route::get('', [Modules\FleetService\Http\Controllers\Driver\DriverController::class, "viewDrivers"]);
        Route::post('add/', [Modules\FleetService\Http\Controllers\Driver\DriverController::class, "storeDriver"]);
        Route::get('{driver_id}/driver_timeline', [Modules\FleetService\Http\Controllers\Driver\DriverController::class, "showDriverTimeline"]);
        Route::delete('{driver_id}/delete', [Modules\FleetService\Http\Controllers\Driver\DriverController::class, "delete_driver"]);
        Route::get('{driver_id}/details', [Modules\FleetService\Http\Controllers\Driver\DriverController::class, "showDriver"]);
        Route::post('{driver_id}/update', [Modules\FleetService\Http\Controllers\Driver\DriverController::class, "updateDriver"]);
    });

    Route::group(['prefix' => 'vehicle-lease/'], function () {
    });
    Route::group(['prefix' => 'vehicle-maintenance/'], function () {
        Route::get('/maintenance', [Modules\FleetService\Http\Controllers\VehicleMaintenance\VehicleMaintenanceController::class, "viewFleetMaintenance"]);
        Route::post('/store', [Modules\FleetService\Http\Controllers\VehicleMaintenance\VehicleMaintenanceController::class, "storeFleetMaintenance"]);
        Route::get('/fuel', [Modules\FleetService\Http\Controllers\VehicleFuel\VehicleFuelController::class, "viewFleetFuelList"]);
        Route::post('/store', [Modules\FleetService\Http\Controllers\VehicleFuel\VehicleFuelController::class, "storeFleetFuel"]);
    });
    Route::group(['prefix' => 'driver-area/'], function () {
    });
});
