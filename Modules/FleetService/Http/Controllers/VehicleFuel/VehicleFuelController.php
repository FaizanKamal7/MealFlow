<?php

namespace Modules\FleetService\Http\Controllers\VehicleFuel;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class VehicleFuelController extends Controller
{
    /**
     * Display a listing of the resource.

     */
    public function viewFuelLogs()
    {
        return view('fleetservice::Fleets.logs.fuels');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request

     */
    public function storeFuelLog(Request $request)
    {

    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id

     */
    public function editFuelLog($id)
    {
        return view('fleetservice::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id

     */
    public function updateFuelLog(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id

     */
    public function destroyFuelLog($id)
    {
        //
    }
}
