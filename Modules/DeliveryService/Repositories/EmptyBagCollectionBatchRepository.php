<?php

namespace Modules\DeliveryService\Repositories;

use App\Enum\BatchStatusEnum;
use Modules\DeliveryService\Entities\EmptyBagCollectionBatch;
use Modules\DeliveryService\Interfaces\EmptyBagCollectionBatchInterface;

class EmptyBagCollectionBatchRepository implements EmptyBagCollectionBatchInterface
{

    public function createEmptyBagCollectionBatch($driver_id)
    {
        return EmptyBagCollectionBatch::create([
            "batch_start_time" => null,
            "batch_end_time" => null,
            "batch_arrival_map_coordinates" => null,
            "batch_end_map_coordinates" => null,
            "status" => BatchStatusEnum::ASSIGNED->value,
            "vehicle_id" => null,
            "driver_id" => $driver_id,
        ]);
    }

    public function getActiveDeliveryBatchByDriver($driver_id)
    {
        $batch = EmptyBagCollectionBatch::where('driver_id', $driver_id)->where('batch_end_time', null)->first();
        if (!$batch) {
            $batch =  $this->createEmptyBagCollectionBatch($driver_id);
        }
        return $batch;
    }
}
