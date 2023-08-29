<?php

use Illuminate\Http\Request;
use Modules\FleetService\Http\Controllers\APIControllers\APIController;


// Route::middleware('auth:api')->get('/fleetservice', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware'=>'auth:sanctum'],function (){
    Route::post('/vehicles',[APIController::class,'getVehicles']);

});