<?php

namespace Modules\FleetService\Http\Controllers\Settings;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class VehicleTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function viewVehicleTypes()
    {
        return view('fleetservice::Fleets.settings.fleet_types');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeVehicleType(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function editVehicleType($id)
    {
        return view('fleetservice::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function updateVehicleType(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyVehicleType($id)
    {
        //
    }
}
