<?php
namespace Modules\FleetService\Repositories;
use Modules\FleetService\Entities\Driver;
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
    public function removeAreasByDriverID($driver_id){
        DriverArea::where('driver_id', $driver_id)->delete();

    }
    public function updateDriverAreas($driver_id,$areas){
        // $driver = Driver::findOrFail($id);
        // $driver->areas()->sync($areas);
        // TODO USING SYNC
        DriverArea::where('driver_id', $driver_id)->delete();
        // $data = collect($areas)->map(function ($areaId) use ($driver_id) {
        //     return [
        //         'driver_id' => $driver_id,
        //         'area_id' => $areaId,
        //         'created_at'=> now(),
        //         'updated_at'=> now(),

        //     ];
        // })->toArray();
      
        // DriverArea::insert($data);
     }
 
}