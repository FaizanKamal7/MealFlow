<?php

namespace Modules\DeliveryService\Repositories;

use App\Enum\BatchStatusEnum;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\DB;
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
      "status" => "Assigned",
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
    $deliveryBatch = DB::table('delivery_batches')
      ->where('driver_id', $driver_id)
      ->whereNull('batch_end_time')
      ->first();

    // Fetch all related data in bulk:

    $deliveries = [];
    $customerAddresses = [];
    $customers = [];
    $users = [];
    $deliverySlots = [];

    if ($deliveryBatch) {
      $deliveries = DB::table('deliveries')
        ->where('delivery_batch_id', $deliveryBatch->id)
        ->get()
        ->keyBy('id');

      $customerAddressIds = $deliveries->pluck('customer_address_id');
      $customerAddresses = DB::table('customer_addresses')
        ->select('id', 'address', 'latitude', 'longitude')
        ->whereIn('id', $customerAddressIds)
        ->get()
        ->keyBy('id');

      $customerIds = $deliveries->pluck('customer_id');
      $customers = DB::table('customers')
        ->select('id', 'user_id')
        ->whereIn('id', $customerIds)
        ->get()
        ->keyBy('id');

      $userIds = $customers->pluck('user_id');
      $users = DB::table('users')
        ->select('id', 'name', 'phone')
        ->whereIn('id', $userIds)
        ->get()
        ->keyBy('id');

      $deliverySlotIds = $deliveries->pluck('delivery_slot_id');
      $deliverySlots = DB::table('delivery_slots')
        ->select('id', 'start_time', 'end_time')
        ->whereIn('id', $deliverySlotIds)
        ->get()
        ->keyBy('id');
    }
    // Group the data:

    foreach ($deliveries as $delivery) {
      $delivery->customerAddress = $customerAddresses[$delivery->customer_address_id] ?? null;
      $delivery->customer = $customers[$delivery->customer_id] ?? null;
      if ($delivery->customer) {
        $delivery->customer->user = $users[$delivery->customer->user_id] ?? null;
      }
      $delivery->deliverySlot = $deliverySlots[$delivery->delivery_slot_id] ?? null;
    }

    $deliveryBatch->deliveries = $deliveries;


    // CHANGED THIS FOR ABOVE AS COLLECTION IS NOT SUITABLE FOR LARGE AMOUNT OF DATA. REFER TO THIS FOR MORE INFO https://laracasts.com/discuss/channels/eloquent/eloquent-eager-loading-slow
    // $batch = DeliveryBatch::with([
    //   'deliveries',
    //   'deliveries.customerAddress' => function ($query) {
    //     $query->select('id', 'address', 'latitude', 'longitude');
    //   },
    //   'deliveries.customer' => function ($query) {
    //     $query->select('id', 'user_id');
    //   },
    //   'deliveries.customer.user' => function ($query) {
    //     $query->select('id', 'name', 'phone');
    //   },
    //   'deliveries.deliverySlot' => function ($query) {
    //     $query->select('id', 'start_time', 'end_time');
    //   },
    // ])->where('driver_id', $driver_id)->where('batch_end_time', null)->first();



    // $batch = DB::table('delivery_batches')
    //   ->leftJoin('deliveries', 'deliveries.delivery_batch_id', '=', 'delivery_batches.id')
    //   ->leftJoin('customer_addresses', 'deliveries.customer_address_id', '=', 'customer_addresses.id')
    //   ->leftJoin('customers', 'deliveries.customer_id', '=', 'customers.id')
    //   ->leftJoin('users', 'customers.user_id', '=', 'users.id')
    //   ->leftJoin('delivery_slots', 'deliveries.delivery_slot_id', '=', 'delivery_slots.id')
    //   ->select(
    //     'delivery_batches.*',
    //     'deliveries.*',
    //     'customer_addresses.id as ca_id',
    //     'customer_addresses.address',
    //     'customer_addresses.latitude',
    //     'customer_addresses.longitude',
    //     'customers.id as c_id',
    //     'customers.user_id',
    //     'users.id as u_id',
    //     'users.name',
    //     'users.phone',
    //     'delivery_slots.id as ds_id',
    //     'delivery_slots.start_time',
    //     'delivery_slots.end_time'
    //   )
    //   ->where('delivery_batches.driver_id', $driver_id)
    //   ->whereNull('delivery_batches.batch_end_time')
    //   ->first();

    return $deliveryBatch;
  }
}
