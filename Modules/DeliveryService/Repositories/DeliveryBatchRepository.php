<?php

namespace Modules\DeliveryService\Repositories;

use Modules\DeliveryService\Entities\DeliveryBatch;
use Modules\DeliveryService\Interfaces\DeliveryBatchInterface;



class DeliveryBatchRepository implements DeliveryBatchInterface {

    public function createDeliveryBatch($driver_id){
       return DeliveryBatch::create([
        "batch_start_time"=>null,
        "batch_end_time"=> null,
        "batch_arrival_map_coordinates"=>null,
        "batch_end_map_coordinates"=>null,
        "status"=>"Assigned",
        "vehicle_id"=>null,
        "driver_id"=>$driver_id,
       ]);

    }

    public function getActiveDeliveryBatchByDriver($driver_id){
        $batch = DeliveryBatch::where('driver_id',$driver_id)->where('batch_end_time',null)->first();
        if(!$batch)
        {
          $batch =  $this->createDeliveryBatch($driver_id);
        }
        return $batch;
    }
}   