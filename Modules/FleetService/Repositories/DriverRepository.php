<?php

namespace Modules\FleetService\Repositories;

use Modules\FleetService\Entities\Driver;
use Modules\FleetService\Entities\DriverArea;
use Modules\FleetService\Interfaces\DriverInterface;

class DriverRepository implements DriverInterface
{

    public function createDriver($employee_id, $license_number, $is_available, $license_document, $license_issue_date, $license_expiry_date)
    {

        $driver = Driver::create([
            'license_number' => $license_number,
            'is_available' => $is_available,
            'license_document' => $license_document,
            'license_issue_date' => $license_issue_date,
            'license_expiry_date' => $license_expiry_date,
            'employee_id' => $employee_id,
        ]);

        $driver->save();
        return $driver;
    }

    public function updateDriver($id, $license_number, $is_available, $license_document, $license_issue_date, $license_expiry_date)
    {

        $driver = Driver::findorFail($id);

        $driver->license_number = $license_number;
        $driver->is_available = $is_available;
        $driver->license_document = $license_document;
        $driver->license_issue_date = $license_issue_date;
        $driver->license_expiry_date = $license_expiry_date;

        return $driver->save();
    }
    public function updateDriverAreas($id, $areas)
    {
        // $driver = Driver::findOrFail($id);
        // $driver->areas()->sync($areas);
        // TODO USING SYNC
        DriverArea::where('driver_id', $id)->delete();
    }
    public function getDrivers()
    {
        return Driver::all();
    }
    public function getDetailDrivers()
    {
        return Driver::with('employee', 'areas', 'lastIncompleteTimeline')->get();
    }
    public function getDriver($id)
    {
        return Driver::find($id);
    }
    public function getDriverWithDeliveries($driver_id)
    {
        return Driver::with('deliveries')->where('id', $driver_id)->get();
    }

    public function getDriverByEmployeeId($employee_id)
    {
        return Driver::where(["employee_id" => $employee_id])->first();
    }
    public function getDriversbyAreaID($area_id, $slot_start, $slot_end)
    {
        return Driver::select('drivers.*')
            ->join('driver_areas', 'drivers.id', '=', 'driver_areas.driver_id')
            ->join('employees', 'drivers.employee_id', '=', 'employees.id')
            ->where('driver_areas.area_id', $area_id)
            ->whereTime('employees.duty_start_time', '<=', $slot_start)
            ->whereTime('employees.duty_end_time', '>=', $slot_end)
            ->get();
    }

    public function delete_driver($id)
    {
        return Driver::find($id)->delete();
    }
}
