<?php

namespace Modules\FleetService\Http\Controllers\VehicleMaintenance;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Log;
use Modules\FleetService\Interfaces\VehicleInterface;
use Modules\FleetService\Interfaces\MaintenanceCategoryInterface;
use Modules\FleetService\Interfaces\VehicleMaintenanceInterface;
use Modules\HRManagement\Interfaces\EmployeesInterface;


class VehicleMaintenanceController extends Controller
{

    private VehicleInterface $vehicleRepository;
    private MaintenanceCategoryInterface $maintenanCategoryRepository;
    private VehicleMaintenanceInterface $VehicleMaintenanceRepository;
    private EmployeesInterface $employeeRepository;
    public function __construct(VehicleInterface $vehicleRepository, MaintenanceCategoryInterface $maintenanCategoryRepository,VehicleMaintenanceInterface $vehicleMaintenanceRepository,EmployeesInterface $employeeRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->maintenanCategoryRepository = $maintenanCategoryRepository;
        $this->VehicleMaintenanceRepository = $vehicleMaintenanceRepository;
        $this->employeeRepository = $employeeRepository;

    }

    /**
     * Display a listing of the resource.

     */
    public function viewFleetMaintenance()
    {
    
          $context = [
            "vehicles" => $this->vehicleRepository->getVehicles(),
            "maintenanceCategories" => $this->maintenanCategoryRepository->getMaintenanceCategories(),
            "employees"=>$this->employeeRepository->getEmployees(),
            "vehiclesMaintenances"=>$this->VehicleMaintenanceRepository->getVehiclesMaintenances(),
        ];
        return view('fleetservice::Fleets.logs.maintenance', $context);
    }



    /**
     * Store a newly created resource in storage.
     * @param Request $request

     */
    public function storeFleetMaintenance(Request $request)
    {
        $data = $request->validate([
            'vehicle_id' => 'required',
            'employee_id' => 'required',
            'maintenance_date' => 'required|date',
            'meter_reading' => 'nullable|integer',
            'maintenance_category_id' => 'required',
            'quantity' => 'required|string',
            "maintenance_detail"=>'',
            'cost' => 'required|numeric',
            'payment_status' => 'required|in:paid,unpaid',
            'paid_date' => 'nullable|date',
            'garage' => 'nullable|string',
            "notes"=>'',
        ]);
        try {

            $vehicleMaintenance = $this->VehicleMaintenanceRepository->createVehicleMaintenance($data);

            if (!$vehicleMaintenance) {
               return redirect()->back()->with("error", "Something went wrong! contact support");
            }

            return redirect()->back()->with('success', 'Maintenance record created successfully.');


        } catch (Exception $exception) {
            Log::error($exception);
            error_log("error " . $exception);
            dd($exception);
            return redirect()->back()->with("error", "Something went wrong! contact support");
        }
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
