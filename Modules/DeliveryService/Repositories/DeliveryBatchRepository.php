<?php

namespace Modules\DeliveryService\Repositories;

use App\Enum\BatchStatusEnum;
use Illuminate\Bus\Batch;
use Modules\DeliveryService\Entities\DeliveryBatch;
use Modules\DeliveryService\Interfaces\DeliveryBatchInterface;


class DeliveryBatchRepository implements DeliveryBatchInterface
{

  public function createDeliveryBatch($driver_id)
  {
    return DeliveryBatch::create([
      "batch_start_time" => null,
      "batch_end_time" => null,
      "batch_arrival_map_coordinates" => null,
      "batch_end_map_coordinates" => null,
      "status" => BatchStatusEnum::ASSIGNED->value,
      "vehicle_id" => null,
      "driver_id" => $driver_id,
    ]);
  }

  public function updateDeliveryBatch($batch_id, $data)
  {
    $batch =  DeliveryBatch::findOrFail($batch_id);
    return $batch->update($data);
  }

  public function getActiveDeliveryBatchByDriver($driver_id)
  {
    $batch = DeliveryBatch::where('driver_id', $driver_id)->where('batch_end_time', null)->first();
    if (!$batch) {
      $batch =  $this->createDeliveryBatch($driver_id);
    }
    return $batch;
  }




  public function getDriverActiveBatchWithDeliveries($driver_id)
  {
    $batch = DeliveryBatch::with([
      'deliveries',
      'deliveries.customerAddress' => function ($query) {
        $query->select('id', 'address', 'latitude', 'longitude');
      },
      'deliveries.customer' => function ($query) {
        $query->select('id', 'user_id');
      },
      'deliveries.customer.user' => function ($query) {
        $query->select('id', 'name', 'phone');
      },
      'deliveries.deliverySlot' => function ($query) {
        $query->select('id', 'start_time', 'end_time');
      },


    ])->where('driver_id', $driver_id)->where('batch_end_time', null)->first();

    return $batch;
  }
}
