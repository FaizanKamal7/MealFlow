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

Route::prefix('fleetservice')->group(function () {
    Route::get('/', 'FleetServiceController@index');
});

Route::prefix('fleets')->group(function () {
    Route::get('/', [\Modules\FleetService\Http\Controllers\Dashboard\DashboardController::class, "viewDashboard"])->name("fleet_dashboard");
    Route::get('all', [Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class, 'viewVehicles'])->name("all_fleets");
    Route::get('details', [\Modules\FleetService\Http\Controllers\Fleet\FleetController::class, "viewFleetDetails"])->name("fleet_details");
    Route::get('add', [\Modules\FleetService\Http\Controllers\Fleet\FleetController::class, "addFleet"])->name("add_fleet");
    Route::get('edit/{id}', [\Modules\FleetService\Http\Controllers\Fleet\FleetController::class, "editFleet"])->name("edit_fleet");

    Route::group(['prefix' => 'vehicle/'], function () {
        Route::get('', [Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class, 'viewVehicles'])->name("fleet_vehicle");
        Route::get('add/', [Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class, 'addVehicle'])->name("fleet_vehicle_add");
        Route::post('add/', [Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class, 'storeVehicle'])->name("fleet_vehicle_store");
        
        Route::delete('{vehicle_id}/delete', [Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class, 'destroyVehicle'])->name("fleet_vehicle_delete");


        Route::get('{vehicle_id}/details/', [Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class, 'viewvehicleDetail'])->name("fleet_vehicle_detail");
        Route::get('{vehicle_id}/edit', [Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class, 'editVehicle'])->name("fleet_vehicle_edit");
        Route::post('{vehicle_id}/edit', [Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class, 'updateVehicle'])->name("fleet_vehicle_update");
      
        Route::get('is-unique-vehicle/', [Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class, 'isUniqueVehicle'])->name("fleet_vehicle_is_unique");
        Route::get('get-make-models/', [Modules\FleetService\Http\Controllers\Vehicle\VehicleController::class, 'getMakeModels'])->name("fleet_vehicle_get_make_models");


    });
    Route::group(['prefix' => 'logs/'], function () {
        Route::get('fuels', [\Modules\FleetService\Http\Controllers\VehicleFuel\VehicleFuelController::class, "viewFuelLogs"])->name("fleet_fuel_logs");
        Route::get('maintenance', [\Modules\FleetService\Http\Controllers\VehicleMaintenance\VehicleMaintenanceController::class, "viewFleetMaintenance"])->name("fleet_maintenance_logs");
    });
    Route::group(['prefix' => 'settings/'], function () {
    // ------------------------------------------   VEHICLE MODELS URL ------------------------------------------------------------------------------------

        Route::get('make', [\Modules\FleetService\Http\Controllers\Settings\VehicleMakeController::class, "viewVehicleMake"])->name("view_vehicle_make");
        Route::get('models', [\Modules\FleetService\Http\Controllers\Settings\VehicleModelsController::class, "viewVehicleModels"])->name("view_vehicle_models");
        Route::Post('add_models', [\Modules\FleetService\Http\Controllers\Settings\VehicleModelsController::class, "storeVehicleModel"])->name("add_vehicle_models");
        Route::post('{vehicle_model}/delete_vehicle_modle', [\Modules\FleetService\Http\Controllers\Settings\VehicleModelsController::class, "destroyVehicleModel"])->name("delete_vehicle_model");
        Route::post('{model_id}/update_vehicle_model', [\Modules\FleetService\Http\Controllers\Settings\VehicleModelsController::class, "updateVehicleModel"])->name("update_vehicle_model");
    // ------------------------------------------   VEHICLE TYPES URL ------------------------------------------------------------------------------------
        Route::get('types', [\Modules\FleetService\Http\Controllers\Settings\VehicleTypesController::class, "viewVehicleTypes"])->name("view_vehicle_types");
        Route::post('add_type', [\Modules\FleetService\Http\Controllers\Settings\VehicleTypesController::class, "storeVehicleType"])->name("add_vehicle_types");
        Route::post('{type_id}/update_vehicle_type', [\Modules\FleetService\Http\Controllers\Settings\VehicleTypesController::class, "updateVehicleType"])->name("update_vehicle_make");
        Route::post('{type_id}/delete_type', [\Modules\FleetService\Http\Controllers\Settings\VehicleTypesController::class, "destroyVehicleType"])->name("delete_vehicle_type");


    });

    Route::group(['prefix' => 'drivers/'], function () {
        Route::get('', [Modules\FleetService\Http\Controllers\Driver\DriverController::class, "viewDrivers"])->name("fleet_view_drivers");
        Route::post('add/', [Modules\FleetService\Http\Controllers\Driver\DriverController::class, "storeDriver"])->name("fleet_store_driver");
        Route::get('{driver_id}/driver_timeline', [Modules\FleetService\Http\Controllers\Driver\DriverController::class, "showDriverTimeline"])->name("fleet_view_driver_timeline");

        Route::get('{driver_id}/details', [Modules\FleetService\Http\Controllers\Driver\DriverController::class, "showDriver"])->name("fleet_view_driver_detail");
        Route::post('{driver_id}/update', [Modules\FleetService\Http\Controllers\Driver\DriverController::class, "updateDriver"])->name("fleet_update_driver_detail");

    });

    Route::group(['prefix' => 'vehicle-lease/'], function () {

    });
    Route::group(['prefix' => 'vehicle-maintenance/'], function () {

    });
    Route::group(['prefix' => 'driver/'], function () {

    });
    Route::group(['prefix' => 'driver-area/'], function () {

    });
});