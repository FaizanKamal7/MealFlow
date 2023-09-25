<?php
namespace Modules\FleetService\Interfaces;

interface DriverInterface {
    public function createDriver($employee_id,$license_number,$is_available,$license_document,$license_issue_date,$license_expiry_date);
    public function updateDriver($id,$license_number, $is_available, $license_document, $license_issue_date, $license_expiry_date);
    public function updateDriverAreas($id,$areas);
    public function getDrivers();
    public function getDetailDrivers();
    public function getDriver($id);
    public function getDriversbyAreaID($area_id,$slot_start,$slot_end);
    public function getDriverByEmployeeId($employee_id);
    public function delete_driver($id);

}