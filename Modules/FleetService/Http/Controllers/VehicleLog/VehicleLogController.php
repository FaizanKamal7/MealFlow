<?php

namespace Modules\FleetService\Http\Controllers\VehicleLog;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Log;
use Modules\FleetService\Interfaces\VehicleLogInterface;

class VehicleLogController extends Controller
{

    private VehicleLogInterface $vehicleLogRepository;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */


    public function __construct(VehicleLogInterface $vehicleRepository){
        $this->vehicleLogRepository = $vehicleRepository;
    }

    
    public function index()
    {
        return view('fleetservice::index');
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
     */
    public function storeVehicleLog(Request $request)
    {
        try {
            $vehicle_id = $request->get("vehicle_id");
            $driver_id = $request->get("driver_id");
            $device_detail = $request->get("device_detail");
            $check_in_time =  date('Y-m-d H:i:s');
            $this->vehicleLogRepository->createVehicleLog(vehileID:$vehicle_id,driveID:$driver_id,checkInTime:$check_in_time,checkOutTime:"",checkedOutUser:"", deviceDetails:$device_detail);
        }
        catch(Exception $exception)
        {
            Log::error($exception);
            error_log("error" . $exception);
        }
        
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
     */
    public function updateVehicleLog(Request $request, $id)
    {
        try {
            $checkout_user = $request->get("checked_out_user");
            $device_detail = $request->get("device_detail");
            $check_out_time =  date('Y-m-d H:i:s');
            $this->vehicleLogRepository->updateVehicleLog(id:$id ,checkOutTime:$check_out_time,checkedOutUser:$checkout_user, deviceDetails:$device_detail);
        }
        catch(Exception $exception)
        {
            Log::error($exception);
            error_log("error" . $exception);
        }
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
