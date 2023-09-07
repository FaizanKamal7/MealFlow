<?php

namespace Modules\FleetService\Http\Controllers\Fleet;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FleetController extends Controller
{
    /**
     * Display a listing of the resource.

     */
    public function viewFleets()
    {
        return view('fleetservice::Fleets.all_fleets');
    }

    public function viewFleetDetails(Request $request)
    {
        return view('fleetservice::Fleets.fleet_detail');
    }


    /**
     * Show the form for creating a new resource.

     */
    public function addFleet()
    {
        return view('fleetservice::Fleets.add_fleet');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request

     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id

     */
    public function editFleet($id)
    {
        return view('fleetservice::Fleets.edit_fleet');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id

     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id

     */
    public function destroy($id)
    {
        //
    }
}
