<?php

namespace Modules\FleetService\Http\Controllers\Settings;

use Illuminate\Contracts\Support\Renderable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\FleetService\Interfaces\VehicleTypeInterface;

class VehicleTypesController extends Controller
{
    private VehicleTypeInterface $vehicleTypeRepository;

    /**
     * @param VehicleTypeInterface $vehicleTypeRepository;
     */

    public function __construct(VehicleTypeInterface $vehicleTypeRepository)
    {
        $this->vehicleTypeRepository = $vehicleTypeRepository;
    }


    /**
     * Display a listing of the resource.
     */public function viewVehicleTypes()
    {
        $types = $this->vehicleTypeRepository->getVehicleTypes();
        $data = ["types" => $types];
        return view('fleetservice::Fleets.settings.fleet_types', $data);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeVehicleType(Request $request)
    {
        try {
            $type = strtolower($request->get("vehicle_type"));
            $capacity = $request->get("vehicle_capacity");
            $active_status = $request->has("active_status") ? 1 : 0;

            if ($this->vehicleTypeRepository->isVehicleTypeExists($type)) {
                return redirect()->route("view_vehicle_types")->with("error", "Vehicle Type Already exist");
            }
            $vehicle_type = $this->vehicleTypeRepository->createVehicleType($type, $capacity, $active_status);
            if (!$vehicle_type) {
                return redirect()->route("view_vehicle_types")->with("error", "Something went wrong! Contact support");
            }
            return redirect()->route("view_vehicle_types")->with("success", "Vehicle Type Added Successfully");

        } catch (Exception $exception) {
            Log::error($exception);
            error_log("error " . $exception);
        }
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
        try {
            $type = strtolower($request->get("updated_type_name"));
            $capacity = $request->get("updated_type_capacity");
            $active_status = $request->has("updated_active_status") ? 1 : 0;

            // if ($this->vehicleTypeRepository->isVehicleTypeExists($type)){
            //     return redirect()->route("view_vehicle_types")->with("error", "Vehicle Type Already exist");
            // }
            $vehicle_type = $this->vehicleTypeRepository->updateVehicleType($id, $type, $capacity, $active_status);
            if (!$vehicle_type) {
                return redirect()->route("view_vehicle_types")->with("error", "Something went wrong! Contact support");
            }

            return redirect()->route("view_vehicle_types")->with("success", "Vehicle Type Updated Successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            error_log("error" . $exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyVehicleType($id)
    {
        try {
            if (!$this->vehicleTypeRepository->deleteVehicleType($id)) {
                return redirect()->route("view_vehicle_types")->with("error", "Something went wrong! Contact support");
            }
            return redirect()->route("view_vehicle_types")->with("success", "Vehicle Type Deleted Successfully");

        } catch (Exception $exception) {
            Log::error($exception);
            error_log("error" . $exception);
        }
    }
}