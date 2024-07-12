<?php

namespace Modules\FleetService\Http\Controllers\Settings;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Exception;
use Illuminate\Support\Facades\Log;
use Modules\FleetService\Interfaces\VehicleModelInterface;


class VehicleModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private VehicleModelInterface $vehicleModelRepository;

    /**
     * @param VehicleModelInterface $vehicleModelRepository
     */

    public function __construct(VehicleModelInterface $vehicleModelRepository)
    {
        $this->vehicleModelRepository = $vehicleModelRepository;
    }
    public function viewVehicleModels()
    {
        $models = $this->vehicleModelRepository->getMakeandmodels();
        $data = ['models' => $models];
        return view('fleetservice::Fleets.settings.fleet_model', $data);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request

     */
    public function storeVehicleModel(Request $request)
    {
        try {

            $vehicle_make = strtolower($request->get("vehicle_make"));
            $vehicle_model = strtolower($request->get("vehicle_model"));
            $active_status = $request->has("active_status") ? 1 : 0;

            if ($this->vehicleModelRepository->isMakeModelExist($vehicle_make, $vehicle_model)) {
                return redirect()->route("view_vehicle_models")->with("error", "Vehicle Make Model Already exist");
            }
            $vehicle_make_model = $this->vehicleModelRepository->createVehicleModel($vehicle_make, $vehicle_model, $active_status);
            if (!$vehicle_make_model) {
                return redirect()->route("view_vehicle_models")->with("error", "Something went wrong! Contact support");
            }
            return redirect()->route("view_vehicle_models")->with("success", "Vehicle Model Added Successfully");

        } catch (Exception $exception) {
            Log::error($exception);
            error_log("error " . $exception);
        }
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
        try {
            $make = strtolower($request->get('update_vehicle_make'));
            $model = strtolower($request->get('update_vehicle_model'));
            $status =  $request->has("update_vehicle_active_status") ? 1 : 0;


            // if ($this->vehicleModelRepository->isMakeModelExist($make,$model)){
            //     return redirect()->route("view_vehicle_models")->with("error", "Vehicle Make Model Already exist");
            // }


            $vehicle_model = $this->vehicleModelRepository->updateVehicleModel($make, $model, $status, $id);

            if (!$vehicle_model) {
                return redirect()->route("view_vehicle_models")->with("error", "Something went wrong! Contact support");
            }
            return redirect()->route("view_vehicle_models")->with("success", "Vehicle Model Updated Successfully");

        } catch (Exception $exception) {
            Log::error($exception);
            error_log("error " . $exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id

     */
    public function destroyVehicleModel($id)
    {
        try {
            if (!$this->vehicleModelRepository->deleteVehicleModel($id)) {
                return redirect()->route("view_vehicle_models")->with("error", "Something went wrong! Contact support");

            }
            return redirect()->route("view_vehicle_models")->with("success", "Vehicle Model Deleted Successfully");


        } catch (Exception $exception) {
            Log::error($exception);
            error_log("error " . $exception);
        }
    }
}