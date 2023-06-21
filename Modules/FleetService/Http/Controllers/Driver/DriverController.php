<?php

namespace Modules\FleetService\Http\Controllers\Driver;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Exception;
use Illuminate\Support\Facades\Log;
use Modules\FleetService\Interfaces\DriverInterface;
use Modules\HRManagement\Http\Helper\Helper;
use Modules\HRManagement\Interfaces\EmployeesInterface;

class DriverController extends Controller
{

    private EmployeesInterface $employeeRepository;
    public DriverInterface $driverRepository;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

     /**
      * @param EmployeesInterface $employeeRepository
      * @param DriverInterface $DriverRepository
      */

    public function __construct(DriverInterface $driverRepository,EmployeesInterface $employeeRepository){
        $this->employeeRepository = $employeeRepository;
        $this->driverRepository = $driverRepository;
    }

    public function viewDrivers()
    {
        $employees = $this->employeeRepository->getEmployees();
        $data = ['employees'=>$employees];
        return view('fleetservice::Fleets.drivers.drivers',$data);
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
    public function storeDriver(Request $request)
    {   
        try{
            $employee_id = $request->get("Employee1");
            $license_number = $request->get("licence_number");
            $licese_document = null;
            $licence_issue_Date = $request->get("licence_issue_Date");
            $licence_expiry_Date = $request->get("licence_expiry_Date");
            $is_available = $request->get("is_available");

            if ($vehiclePicture = $request->file("licence_Document")) {
                $helper = new Helper();
                // $picture = $helper->storeFile($file, "drivers");
            }

            $driver = $this->driverRepository->createDriver($employee_id,$license_number,$is_available,$licese_document,$licence_issue_Date,$licence_expiry_Date);
            return redirect()->route('fleet_view_drivers');

        }
        catch(Exception $exception){
            Log::error($exception);
            error_log("error " . $exception);
            echo($exception);
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
