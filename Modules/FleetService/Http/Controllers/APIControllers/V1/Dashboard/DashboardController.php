<?php

namespace Modules\FleetService\Http\Controllers\APIControllers\V1\Dashboard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\FleetService\Interfaces\DriverInterface;
use Modules\FleetService\Interfaces\VehicleInterface;
use Modules\FleetService\Interfaces\VehicleTimelineInterface;
use Modules\FleetService\Interfaces\VehicleModelInterface;
use Modules\FleetService\Interfaces\VehicleTypeInterface;
use App\Traits\HttpResponses;

class DashboardController extends Controller
{
    use HttpResponses;
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


    public function getDashboardData()
    {

        $vehicles = $this->vehicleRepository->getDetailedVehicles();
        $vehicletypes =$this->vehicleTypeRepository->getActiveVehicleTypes();
        // $vehicletimeline = $this->vehicleLogRepository->getallVehicletimeline();
        $vehicletimeline="";
        $data = ['vehicles'=>$vehicles,'vehicleTypes'=>$vehicletypes,'vehicleLogs'=>$vehicletimeline];

        return $this->success($data);
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
