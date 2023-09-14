<?php

namespace Modules\FleetService\Http\Controllers\APIControllers\V1\Settings;

use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\FleetService\Interfaces\VehicleTypeInterface;

class VehicleTypesController extends Controller
{
    use HttpResponses;
    private VehicleTypeInterface $vehicleTypeRepository;

    /**
     * @param VehicleTypeInterface $vehicleTypeRepository;
     */

    public function __construct(VehicleTypeInterface $vehicleTypeRepository)
    {
        $this->vehicleTypeRepository = $vehicleTypeRepository;
    }


    public function getVehicleTypes()
    {
        try {
            $types = $this->vehicleTypeRepository->getVehicleTypes();
            $data = ["types" => $types];
            return $this->success($data, "vehicle types");
        } catch (Exception $e) {
            return $this->error($e, "Something went wrong, contact support");
        }

    }

    public function getActiveVehicleTypes()
    {
        try {
            $types = $this->vehicleTypeRepository->getActiveVehicleTypes();
            $data = ["types" => $types];
            return $this->success($data, "vehicle types");
        } catch (Exception $e) {
            return $this->error($e, "Something went wrong, contact support");
        }
    }
    
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeVehicleType(Request $request)
    {
        $request->validate([
            'vehicle_type' => ['required', 'unique:vehicle_types,name'],
            'vehicle_capacity' => ['required'],
            'vehicle_icon' => ['required'],
        ]);

        try {
            $type = $request->get("vehicle_type");
            $capacity = $request->get("vehicle_capacity");
            $icon = $request->get("vehicle_icon");
            $active_status = $request->has("active_status") ? 1 : 0;

            if ($this->vehicleTypeRepository->isVehicleTypeExists($type)) {
                return redirect()->route("view_vehicle_types")->with("error", "Vehicle Type Already exist");
            }
            $vehicle_type = $this->vehicleTypeRepository->createVehicleType($type, $capacity, $icon, $active_status);
            if (!$vehicle_type) {
                return redirect()->route("view_vehicle_types")->with("error", "Something went wrong! Contact support");
            }
            return redirect()->route("view_vehicle_types")->with("success", "Vehicle Type Added Successfully");

        } catch (Exception $exception) {
            echo $exception;
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
        $request->validate([
            'vehicle_type' => ['required', 'unique:vehicle_types,name'],
            'vehicle_capacity' => ['required'],
            'vehicle_icon' => ['required'],
        ]);
        try {
            $type = strtolower($request->get("updated_type_name"));
            $capacity = $request->get("updated_type_capacity");
            $icon = $request->get("updated_type_icon");
            $active_status = $request->has("updated_active_status") ? 1 : 0;

            // if ($this->vehicleTypeRepository->isVehicleTypeExists($type)){
            //     return redirect()->route("view_vehicle_types")->with("error", "Vehicle Type Already exist");
            // }
            $vehicle_type = $this->vehicleTypeRepository->updateVehicleType($id, $type, $capacity, $icon, $active_status);
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