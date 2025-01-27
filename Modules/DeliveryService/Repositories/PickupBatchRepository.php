<?php

namespace Modules\DeliveryService\Repositories;

use App\Enum\BatchStatusEnum;
use Modules\DeliveryService\Entities\PickupBatch;
use Modules\DeliveryService\Interfaces\PickupBatchInterface;

class PickupBatchRepository implements PickupBatchInterface
{

    public function createPickupBatch($driver_id)
    {
        return PickupBatch::create([
            "batch_start_time" => null,
            "batch_end_time" => null,
            "batch_arrival_map_coordinates" => null,
            "batch_end_map_coordinates" => null,
            "status" => BatchStatusEnum::ASSIGNED->value,
            "vehicle_id" => null,
            "driver_id" => $driver_id,
        ]);
    }

    public function updatePickupBatch($batch_id, $data)
    {
        $batch = PickupBatch::findOrFail($batch_id);
        return $batch->update($data);
    }

    public function getActivePickupBatchByDriver($driver_id)
    {
        $batch = PickupBatch::where('driver_id', $driver_id)->where('batch_end_time', null)->first();
        if (!$batch) {
            $batch = $this->createPickupBatch($driver_id);
        }
        return $batch;
    }
    public function getPickupBatchByDriver($driver_id)
    {
        return PickupBatch::where('driver_id', $driver_id)->where('batch_end_time', null)->first();
    }

    public function getDriverActiveBatchWithDeliveries($driver_id)
    {
        $batch = PickupBatch::where('driver_id', $driver_id)->where('batch_end_time', null)->first();
        if (!$batch) {
            $batch = $this->createPickupBatch($driver_id);
        }
        return $batch;
    }
}
