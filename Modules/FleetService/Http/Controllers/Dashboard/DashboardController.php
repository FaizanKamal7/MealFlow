<?php

namespace Modules\FleetService\Http\Controllers\Dashboard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\FleetService\Interfaces\DriverInterface;
use Modules\FleetService\Interfaces\VehicleInterface;
use Modules\FleetService\Interfaces\VehicleLogInterface;
use Modules\FleetService\Interfaces\VehicleModelInterface;
use Modules\FleetService\Interfaces\VehicleTypeInterface;

class DashboardController extends Controller
{
    private VehicleInterface $vehicleRepository;
    private  DriverInterface $driverRepository;
    private VehicleTypeInterface $vehicleTypeRepository;
    // private VehicleLogInterface $vehicleLogRepository;

    public function __construct(VehicleInterface $vehicleRepository,DriverInterface $driverRepository,VehicleTypeInterface $vehicleTypeRepository){
        $this->vehicleRepository = $vehicleRepository;
        $this->driverRepository = $driverRepository;
        $this->vehicleTypeRepository = $vehicleTypeRepository;
        // $this->vehicleLogRepository = $vehicleLogRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function viewDashboard()
    {
        $vehicles = $this->vehicleRepository->getVehicles();
        $vehicletypes =$this->vehicleTypeRepository->getActiveVehicleTypes();
        // $vehicleLogs = $this->vehicleLogRepository->getallVehicleLogs();
        $vehicleLogs="";
        $context = ['vehicles'=>$vehicles,'vehicleTypes'=>$vehicletypes,'vehicleLogs'=>$vehicleLogs];
        
        return view('fleetservice::dashboard.dashboard',$context);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('fleetservice::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('fleetservice::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('fleetservice::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
