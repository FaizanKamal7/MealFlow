<?php

namespace Modules\FleetService\Http\Controllers\Driver;

use App\Interfaces\AreaInterface;
use App\Repositories\AreaRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Exception;
use Illuminate\Support\Facades\Log;
use Modules\FleetService\Http\Requests\DriverRequest;
use Modules\FleetService\Interfaces\DriverAreaInterface;
use Modules\FleetService\Interfaces\DriverInterface;
use Modules\FleetService\Repositories\DriverRepository;
use Modules\HRManagement\Http\Helper\Helper;
use Modules\HRManagement\Interfaces\EmployeesInterface;

class DriverController extends Controller
{

    private EmployeesInterface $employeeRepository;
    private AreaInterface $areaRepository;
    public DriverInterface $driverRepository;
    public DriverAreaInterface $driverAreaRepository;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    /**
     * @param EmployeesInterface $employeeRepository
     * @param DriverInterface $DriverRepository
     */

    public function __construct(DriverInterface $driverRepository, EmployeesInterface $employeeRepository, AreaInterface $areaRepository, DriverAreaInterface $driverAreaRepository)
    {
        $this->employeeRepository = $employeeRepository;
        $this->areaRepository = $areaRepository;
        $this->driverRepository = $driverRepository;
        $this->driverAreaRepository = $driverAreaRepository;
    }

    public function viewDrivers()
    {
        $employees = $this->employeeRepository->getEmployees();
        $drivers = $this->driverRepository->getDrivers();
        $areas = $this->areaRepository->getWhere(["active_status" => 1]);
        $context = ['employees' => $employees, 'drivers' => $drivers, 'areas' => $areas];
        return view('fleetservice::Fleets.drivers.drivers', $context);
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
     *
     */
    public function storeDriver(DriverRequest $request)
    {
        $request->validated();
        try {
            $employee_id = $request->get("Employee1");
            $license_number = $request->get("license_number");
            $licese_document = null;
            $license_issue_Date = $request->get("license_issue_Date");
            $license_expiry_Date = $request->get("license_expiry_Date");
            $is_available = $request->get("is_available");
            $areas = $request->get("driver_areas");
            // if($this->driverRepository->getDriver())
            if ($vehiclePicture = $request->file("license_Document")) {
                $helper = new Helper();
                // $picture = $helper->storeFile($file, "drivers");
            }

            $driver = $this->driverRepository->createDriver($employee_id, $license_number, $is_available, $licese_document, $license_issue_Date, $license_expiry_Date);


            if (!$driver) {
                return redirect()->route("fleet_view_drivers")->with("error", "Something went wrong! Contact support");
            }

            foreach ($areas as $area) {
                $this->driverAreaRepository->createDriverArea($driver->id, $area);
            }

            return redirect()->route('fleet_view_drivers')->with("success", "Driver addded Successfully");

        } catch (Exception $exception) {
            Log::error($exception);
            error_log("error " . $exception);
            echo ($exception);
        }
    }

    /**lkkdsm,nkj  knsdk  djnknds  nsd nlkdsklflkd,sklkl sdh 
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function showDriver($id)
    {
        $driver = $this->driverRepository->getDriver($id);
        $areas = $this->areaRepository->getWhere(["active_status" => 1]);

        $context = ["driver" => $driver, "areas" => $areas];
        return view('fleetservice::Fleets.drivers.driver_detail', $context);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function showDriverTimeline($id)
    {
        $driver = $this->driverRepository->getDriver($id);
        $context = ["driver" => $driver];
        return view('fleetservice::Fleets.drivers.driver_timeline', $context);

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
     * 
     */
    public function updateDriver(DriverRequest $request, $id)
    {
        $request->validated();
        try {

            $license_number = trim($request->get("Driver_License_number"));
            $license_issue_date = $request->get("Driver_license_issue_Date");
            $license_expiry_date = $request->get("Driver_license_expiry_Date");
            $license_document = null; // $request->get("Driver_License_Document");
            $is_available = $request->get("is_available") ? 1 : 0;

            // echo $license_number;
            // return;
            $driver = $this->driverRepository->updateDriver($id, $license_number, $is_available, $license_document, $license_issue_date, $license_expiry_date);

            if (!$driver) {
                return redirect()->route("fleet_view_driver_detail", ['driver_id' => $id])->with("error", "Something went wrong! Contact support");
            }
            return redirect()->route('fleet_view_driver_detail', ['driver_id' => $id])->with("success", "Driver addded Successfully");





        } catch (Exception $exception) {
            Log::error($exception);
            error_log("error " . $exception);
            echo ($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function delete_driver($id)
    {
        try {
            $is_deleted = $this->driverRepository->delete_driver($id);
            if ($is_deleted) {
                return redirect()->route('fleet_view_drivers', )->with("success", "Driver Deleted Successfully");
            }
            else{
           return redirect()->route('fleet_view_drivers', )->with("error", "Something went wrong! Contact support");
            }
        } catch (exception $exception) {
            Log::error($exception);
            error_log("error " . $exception);
           return redirect()->route('fleet_view_drivers', )->with("error", "Something went wrong! Contact support");
        }
    }
}