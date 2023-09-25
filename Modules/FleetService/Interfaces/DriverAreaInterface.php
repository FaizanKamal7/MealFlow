<?php
namespace Modules\FleetService\Interfaces;

interface DriverAreaInterface {
    public function createDriverArea($driver_id,$areaID);
    public function removeAreasByDriverID($driver_id);
    public function updateDriverAreas($driver_id,$areas);


}