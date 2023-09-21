<?php
namespace Modules\FleetService\Repositories;
use Modules\FleetService\Entities\DriverArea;
use Modules\FleetService\Interfaces\DriverAreaInterface;

class DriverAreaRepository implements DriverAreaInterface{

    public function createDriverArea($driver_id,$area_id){
        $driverarea = DriverArea::create([
            "driver_id"=>$driver_id,
            "area_id"=> $area_id,
            ]);

        return $driverarea->save();
    }
 
}