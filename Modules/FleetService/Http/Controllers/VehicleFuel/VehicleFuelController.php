<?php

namespace Modules\FleetService\Http\Controllers\VehicleFuel;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\FleetService\Interfaces\MaintenanceCategoryInterface;
use Modules\FleetService\Interfaces\VehicleFuelInterface;
use Modules\FleetService\Interfaces\VehicleInterface;
use Modules\FleetService\Interfaces\VehicleMaintenanceInterface;
use Modules\HRManagement\Interfaces\EmployeesInterface;

class VehicleFuelController extends Controller
{
    private VehicleInterface $vehicleRepository;
    private EmployeesInterface $employeeRepository;
    private VehicleFuelInterface $vehicleFuelRepository;
    public function __construct(VehicleInterface $vehicleRepository, EmployeesInterface $employeeRepository, VehicleFuelInterface $vehicleFuelRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->employeeRepository = $employeeRepository;
        $this->vehicleFuelRepository = $vehicleFuelRepository;

    }
    /**
     * Display a listing of the resource.

     */
    public function viewFleetFuelList()
    {
        $context = [
            "vehicles" => $this->vehicleRepository->getVehicles(),
            "employees" => $this->employeeRepository->getEmployees(),
            "fuelList"=>$this->vehicleFuelRepository->getFuelList(),
        ];
        return view('fleetservice::Fleets.logs.fleetFuels', $context);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request

     */
    public function storeFleetFuel(Request $request)
    {
        $validatedData = $request->validate([
            'vehicle_id' => 'required',
            'employee_id' => 'required',
            'fuel_type' => 'required|in:diesel,petrol,gas,electric',
            'fuel_quantity' => 'required|numeric|min:0',
            'fuel_date' => 'required|date',
            'fuel_cost' => 'required|numeric|min:0',
            'supplier' => 'required|string|max:100',
            'notes' => 'nullable',
            'payment_method' => 'required|in:topup,cash,credit',
            'paid_date' => 'nullable|date',
        ]);


        if (!$this->vehicleFuelRepository->createVehicleFuel($validatedData)) {
            return redirect()->back()->with("error", "Something went wrong! contact support");

        }
        return redirect()->back()->with('success', 'Fuel record created successfully.');


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