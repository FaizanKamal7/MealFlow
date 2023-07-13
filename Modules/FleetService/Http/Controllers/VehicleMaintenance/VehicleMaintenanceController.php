<?php

namespace Modules\FleetService\Http\Controllers\VehicleMaintenance;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class VehicleMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.

     */
    public function viewFleetMaintenance()
    {
        return view('fleetservice::Fleets.logs.maintenance');
    }



    /**
     * Store a newly created resource in storage.
     * @param Request $request

     */
    public function storeFleetMaintenance(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id

     */
    public function editFleetMaintenance($id)
    {

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id

     */
    public function updateFleetMaintenance(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id

     */
    public function destroyFleetMaintenance($id)
    {
        //
    }
}
