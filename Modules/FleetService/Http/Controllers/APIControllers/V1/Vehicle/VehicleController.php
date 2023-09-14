<?php

namespace Modules\FleetService\Http\Controllers\APIControllers\V1\Vehicle;

use App\Traits\HttpResponses;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\FleetService\Http\Requests\VehicleRequest;
use Modules\FleetService\Interfaces\VehicleInterface;
use Modules\FleetService\Interfaces\VehicleTypeInterface;
use Modules\FleetService\Interfaces\VehicleModelInterface;
use Modules\HRManagement\Http\Helper\Helper;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class VehicleController extends Controller
{
    use HttpResponses;
    // Meta data
    private VehicleInterface $vehicleRepository;
    private VehicleTypeInterface $vehicleTypeRepository;
    private VehicleModelInterface $vehicleModelRepository;


    /**
     * @param VehicleInterface $vehicleRepository
     * @param VehicleTypeInterface $vehicleTypeRepository
     * @param VehicleModelInterface $vehicleModelRepository
     */

    public function __construct(VehicleInterface $vehicleRepository, VehicleTypeInterface $vehicleTypeRepository, VehicleModelInterface $vehicleModelRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->vehicleTypeRepository = $vehicleTypeRepository;
        $this->vehicleModelRepository = $vehicleModelRepository;
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */



    public function index()
    {
        return view('fleetservice::index');
    }

    public function getVehicles()
    {
        // abort_if(Gate::denies('view_vehicle'),Response::HTTP_FORBIDDEN,'403 Forbidden');

        try {


            $vehicles = $this->vehicleRepository->getDetailedVehicles();
            $vehicleTypes = $this->vehicleTypeRepository->getActiveVehicletypes();
            $vehicleMakes = $this->vehicleModelRepository->getActiveVehicleMakes();
            $data = ["vehicles" => $vehicles, "vehicleTypes" => $vehicleTypes, 'vehicleMakes' => $vehicleMakes];
            return $this->success($data, "vehicle Data");

        } catch (Exception $e) {
            return $this->error($e, 'Something went wrong contact support');
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     *
     */
    public function storeVehicle(VehicleRequest $request)
    {
        $path = 'media/vehicle/qrcodes/' . time() . '.svg';
        $request->validated();
        try {

            // Retrieve the values from the request
            $registrationNumber = $request->get('registration_number');
            $engineNumber = $request->get('engine_number');
            $chassisNumber = $request->get('chassis_number');
            $vehicleModelID = $request->get('vehicle_model');
            $vehicleYear = $request->get('vehicle_year');
            $vehicleColor = $request->get('vehicle_color');
            $vehicleStatus = $request->get('vehicle_status');
            $vehicleTypeId = $request->get('vehicle_type');
            $vehiclePicture = null; // Handle file upload
            $vehicleMileage = $request->get('vehicle_mileage');

            // Retrieve insurance details
            $registrationPicture = null; // Handle file upload
            $registrationIssueDate = $request->get('registration_issue_date');
            $registrationExpiryDate = $request->get('registration_expiry_date');

            // Retrieve insurance details
            $insurancePicture = null; // Handle file upload
            $insuranceIssueDate = $request->get('insurance_issue_date');
            $insuranceExpiryDate = $request->get('insurance_expiry_date');

            // Retrieve municipality details
            $municipalityPicture = null; // Handle file upload
            $municipalityIssueDate = $request->get('municipality_issue_date');
            $municipalityExpiryDate = $request->get('municipality_expiry_date');

            $qrCode = null;
            // Retrieve API details
            $apiUnitId = $request->get('api_unit_id');

            if ($vehiclePicture = $request->file("picture")) {
                $helper = new Helper();
                // $picture = $helper->storeFile($file, "employees");
            }

            // Creating Vehicle

            $vehicle = $this->vehicleRepository->createVehicle($registrationNumber, $engineNumber, $chassisNumber, $vehicleModelID, $vehicleYear, $vehicleColor, $vehicleStatus, $vehicleTypeId, $vehiclePicture, $vehicleMileage, $registrationPicture, $registrationIssueDate, $registrationExpiryDate, $insurancePicture, $insuranceIssueDate, $insuranceExpiryDate, $municipalityPicture, $municipalityIssueDate, $municipalityExpiryDate, $apiUnitId, $qrCode);

            if (!$vehicle) {
                return $this->error($vehicle, "Something went wrong! contact support");
            }

            QrCode::size(400)
                ->generate($vehicle->id, public_path($path));
            $fields = ['qr_code' => $path];
            $this->vehicleRepository->updateVehicleFields(id: $vehicle->id, fields: $fields);
            $data = ['vehicle' => $vehicle];
            return $this->success($data, "Vehicle added successfully");

        } catch (Exception $exception) {
            Log::error($exception);
            error_log("error " . $exception);
            return $this->error($exception,$exception->errorInfo,500);


        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function getVehicleDetail(Request $request)
    {
        $id= $request->get('id');
        $vehicle = $this->vehicleRepository->getVehicle($id);
        $data = ['vehicle' => $vehicle];
        return $this->success($data, "Vehicle detail");

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function editVehicle($id)
    {
        $vehicle = $this->vehicleRepository->getVehicle($id);

        $vehicleTypes = $this->vehicleTypeRepository->getActiveVehicleTypes();
        $vehicleMakes = $this->vehicleModelRepository->getActiveVehicleMakes();


        $data = ['vehicle' => $vehicle, "vehicleTypes" => $vehicleTypes, 'vehicleMakes' => $vehicleMakes];
        return view('fleetservice::Fleets.edit_fleet', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function updateVehicle(Request $request, $id)
    {
        try {
            // Retrieve the values from the request
            $registrationNumber = $request->get('registration_number');
            $engineNumber = $request->get('engine_number');
            $chassisNumber = $request->get('chassis_number');
            $vehicleModelID = $request->get('vehicle_model');
            $vehicleYear = $request->get('vehicle_year');
            $vehicleColor = $request->get('vehicle_color');
            $vehicleStatus = $request->get('vehicle_status');
            $vehicleTypeId = $request->get('vehicle_type');
            $vehiclePicture = null; // Handle file upload
            $vehicleMileage = $request->get('vehicle_mileage');

            // Retrieve insurance details
            $registrationPicture = null; // Handle file upload
            $registrationIssueDate = $request->get('registration_issue_date');
            $registrationExpiryDate = $request->get('registration_expiry_date');

            // Retrieve insurance details
            $insurancePicture = null; // Handle file upload
            $insuranceIssueDate = $request->get('insurance_issue_date');
            $insuranceExpiryDate = $request->get('insurance_expiry_date');

            // Retrieve municipality details
            $municipalityPicture = null; // Handle file upload
            $municipalityIssueDate = $request->get('municipality_issue_date');
            $municipalityExpiryDate = $request->get('municipality_expiry_date');

            $qrCode = null;
            // Retrieve API details
            $apiUnitId = $request->get('api_unit_id');

            if ($vehiclePicture = $request->file("picture")) {
                $helper = new Helper();
                // $picture = $helper->storeFile($file, "employees");
            }

            // Creating Vehicle
            $vehicle = $this->vehicleRepository->updateVehicle($id, $registrationNumber, $engineNumber, $chassisNumber, $vehicleModelID, $vehicleYear, $vehicleColor, $vehicleStatus, $vehicleTypeId, $vehiclePicture, $vehicleMileage, $registrationPicture, $registrationIssueDate, $registrationExpiryDate, $insurancePicture, $insuranceIssueDate, $insuranceExpiryDate, $municipalityPicture, $municipalityIssueDate, $municipalityExpiryDate, $apiUnitId, $qrCode);

            return redirect()->route("fleet_vehicle")->with("success", "Vehicle updated successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            error_log("error " . $exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyVehicle($id)
    {

        try {

            $vehicle = $this->vehicleRepository->deleteVehicle($id);
            return redirect()->route("fleet_vehicle")->with("success", "Vehicle Deleted successfully");

        } catch (Exception $exception) {
            Log::error($exception);
            error_log("error " . $exception);
        }
    }

    public function isUniqueVehicle(Request $request)
    {

        // IF THE REGISTRATION NUMBER ALREADY EXIST IT WILL RETURN TRUE
        $field = $request->input('field');
        $value = $request->input('value');

        $unique = false;
        if ($this->vehicleRepository->getVehicleByCriteria($field, $value)) {
            $unique = true;
        }
        // echo $unique;
        return response()->json(['valid' => $unique]);

    }
    /**
     * GETTING ALL MODEL FOR A SPECIFIC MAKE TYPE
     * @param $make inside requeest
     */
    public function getMakeModels(Request $request)
    {
        $make = $request->input('make');
        $models = $this->vehicleModelRepository->getActiveMakeModels($make)->toArray();
        return response()->json(['models' => $models]);
    }
}