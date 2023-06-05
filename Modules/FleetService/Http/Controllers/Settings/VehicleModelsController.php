<?php

namespace Modules\FleetService\Http\Controllers\Settings;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class VehicleModelsController extends Controller
{
    /**
     * Display a listing of the resource.

     */
    public function viewVehicleModels()
    {
        return view('fleetservice::Fleets.settings.fleet_model');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request

     */
    public function storeVehicleModel(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id

     */
    public function editVehicleModel($id)
    {
        return view('fleetservice::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id

     */
    public function updateVehicleModel(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id

     */
    public function destroyVehicleModel($id)
    {
        //
    }
}
