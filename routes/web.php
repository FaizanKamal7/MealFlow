<?php

use App\Http\Controllers\Admin\DeliverySlots\DeliverySlotController;
use App\Http\Controllers\Admin\LocationManagement\Area\AreaController;
use App\Http\Controllers\Admin\LocationManagement\City\CityController;
use App\Http\Controllers\Admin\LocationManagement\LocationController;
use App\Http\Controllers\Admin\LocationManagement\State\StateController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserManagement\ApplicationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboards.admin_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'core/'], function () {
        Route::get('/', function () {
            return view('dashboards.admin_dashboard');
        })->name("admin_dashboard");
        Route::get('fleets/', function () {
            return view('dashboards.fleets_dashboard');
        })->name("fleet_dashboard");
        Route::get('fleets/details', function () {
            return view('fleets.fleet_details');
        })->name("fleet_details");


        Route::group(['prefix' => 'applications/'], function () {
            Route::get("/", [ApplicationController::class, "viewApplication"])->name("applications_view");
            Route::post("add/new", [ApplicationController::class, "storeApplication"])->name("application_store");
            Route::get("{app_id}/edit", [ApplicationController::class, "editApplication"])->name("application_edit");
            Route::post("update", [ApplicationController::class, "updateApplication"])->name("application_update");
            Route::get("{app_id}/delete", [ApplicationController::class, "deleteApplication"])->name("application_delete");
        });

        Route::group(['prefix' => 'permissions/'], function () {
            Route::get("/", [\App\Http\Controllers\Admin\UserManagement\PermissionsController::class, "viewPermissions"])->name("permissions_view");
            Route::post("add/new", [\App\Http\Controllers\Admin\UserManagement\PermissionsController::class, "storePermissions"])->name("permissions_store");
            Route::post("fetch-permission", [\App\Http\Controllers\Admin\UserManagement\PermissionsController::class, "fetchSinglePermission"])->name("fetch_permission");
            Route::post("update", [\App\Http\Controllers\Admin\UserManagement\PermissionsController::class, "updatePermission"])->name("permissions_update");
            Route::get("{permission_id}/delete", [\App\Http\Controllers\Admin\UserManagement\PermissionsController::class, "deletePermission"])->name("permissions_delete");
        });

        Route::group(['prefix' => 'roles/'], function () {
            Route::get("/", [\App\Http\Controllers\Admin\UserManagement\RolesController::class, "viewRoles"])->name("roles_view");
            Route::post("add/new", [\App\Http\Controllers\Admin\UserManagement\RolesController::class, "storeRole"])->name("role_store");
            Route::get("{role_id}/edit", [\App\Http\Controllers\Admin\UserManagement\RolesController::class, "editRole"])->name("role_edit");
            Route::post("update", [\App\Http\Controllers\Admin\UserManagement\RolesController::class, "updateRole"])->name("role_update");
            Route::get("{role_id}/delete", [\App\Http\Controllers\Admin\UserManagement\RolesController::class, "deleteRole"])->name("role_delete");
        });


        Route::group(['prefix' => 'users/'], function () {
            Route::get("/", [App\Http\Controllers\Admin\UserManagement\UsersController::class, 'viewUsers'])->name("users_view");
            Route::post("add/new", [App\Http\Controllers\Admin\UserManagement\UsersController::class, 'storeUsers'])->name("user_store");
            Route::get("{user_id}/details", [\App\Http\Controllers\Admin\UserManagement\UsersController::class, "viewUserDetails"])->name("user_view_details");
            Route::post("update/role", [\App\Http\Controllers\Admin\UserManagement\UsersController::class, "updateUserRoles"])->name("user_update_role");
            Route::get("{user_id}/delete", [\App\Http\Controllers\Admin\UserManagement\UsersController::class, "deleteUser"])->name("user_delete");
        });

        Route::group(['prefix' => 'settings/'], function () {
            Route::get("/", [SettingsController::class, 'index'])->name("settings");

            Route::group(['prefix' => 'locations/'], function () {
                Route::get("/extract-api-areas-of-city/{city_id}/{city_name}", [AreaController::class, "extractAreasOfCityFromAPI"])->name("extract_api_areas_of_city");
                Route::get("/search-city", [CityController::class, "search"])->name("search_city");
                Route::get("/activate-api-areas", [AreaController::class, "activateCityAreas"])->name("activate_city_areas");
                Route::get("/activate-locations-view", [LocationController::class, "index"])->name("activate_locations_view");
                Route::get("/activated-locations", [LocationController::class, "activatedLocations"])->name("activated_locations_view");
                //table data for showing cities-locations file
                Route::get("/table-data", [LocationController::class, "table_data"])->name("table-data");
                //filling table data of activate location by search query result- route
                Route::get("/city-search", [LocationController::class, "search"])->name("city_search");
            });

            Route::group(['prefix' => 'delivery-slots/'], function () {
                Route::get("/get-delivery-slots", [DeliverySlotController::class, "index"])->name("get_all_delivery_slots");
                Route::get("/add-delivery-slots", [DeliverySlotController::class, "addDeliverySlotView"])->name("add_new_delivery_slots");
                Route::post("/store-delivery-slots", [DeliverySlotController::class, "storeDeliverySlots"])->name("store_delivery_slots");
                Route::get("/get-delivery-slots-of-city", [DeliverySlotController::class, "getDeliverySlotsOfCity"])->name("get_delivery_slots_of_city");
            });
        });
    });
});

require __DIR__ . '/auth.php';



// ----- I N F O : No need of authentication to acccces below routes
Route::group(['prefix' => 'core/settings/locations/'], function () {
    Route::get("/get-states", [StateController::class, "getStatesOfCountry"])->name("get_states_of_country");
    Route::get("/get-cities", [CityController::class, "getCitiesOfState"])->name("get_cities_of_state");
    Route::get("/get-areas", [AreaController::class, "getAreasOfCity"])->name("get_areas_of_city");
});

Route::get('docusign', [DocusignController::class, 'index'])->name('docusign');
Route::get('connect-docusign', [DocusignController::class, 'connectDocusign'])->name('connect.docusign');
Route::get('docusign/callback', [DocusignController::class, 'callback'])->name('docusign.callback');
Route::get('sign-document', [DocusignController::class, 'signDocument'])->name('docusign.sign');
