<?php
namespace Modules\FleetService\Interfaces;

interface DriverInterface {
    public function createDriver($employee_id,$license_number,$is_available,$license_document,$license_issue_date,$license_expiry_date);
    public function updateDriver($id,$license_number, $is_available, $license_document, $license_issue_date, $license_expiry_date);

    public function getDrivers();
    public function getDriver($id);

}