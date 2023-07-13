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
        $drivers = $this->driverRepository->getDrivers();
        $context = ['employees'=>$employees,'drivers'=>$drivers];
        return view('fleetservice::Fleets.drivers.drivers',$context);
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
          
            if (!$driver) {
                return redirect()->route("fleet_view_drivers")->with("error", "Something went wrong! Contact support");
            }
            return redirect()->route('fleet_view_drivers')->with("success", "Driver addded Successfully");

        }
        catch(Exception $exception){
            Log::error($exception);
            error_log("error " . $exception);
            echo($exception);
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
        $context = ["driver"=>$driver];
        return view('fleetservice::Fleets.drivers.driver_detail',$context);

    }

     /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function showDriverTimeline($id)
    {
        $driver = $this->driverRepository->getDriver($id);
        $context = ["driver"=>$driver];
        return view('fleetservice::Fleets.drivers.driver_timeline',$context);

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
    public function updateDriver(Request $request, $id)
    {
        try {

            $license_number = trim($request->get("Driver_Licence_number"));
            $license_issue_date = $request->get("Driver_licence_issue_Date");
            $license_expiry_date = $request->get("Driver_licence_expiry_Date");
            $license_document = null; // $request->get("Driver_Licence_Document");
            $is_available = $request->get("is_available")?1 :0;

            // echo $license_number;
            // return;
            $driver = $this->driverRepository->updateDriver($id,$license_number,$is_available,$license_document,$license_issue_date,$license_expiry_date);

            if (!$driver) {
                return redirect()->route("fleet_view_driver_detail",['driver_id'=>$id])->with("error", "Something went wrong! Contact support");
            }
            return redirect()->route('fleet_view_driver_detail',['driver_id'=>$id])->with("success", "Driver addded Successfully");





        }catch(Exception $exception){
            Log::error($exception);
            error_log("error " . $exception);
            echo($exception);
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
