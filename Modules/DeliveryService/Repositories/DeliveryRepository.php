<?php

namespace Modules\DeliveryService\Repositories;

use Modules\DeliveryService\Entities\Delivery;
use Modules\DeliveryService\Interfaces\DeliveryInterface;

class DeliveryRepository implements DeliveryInterface
{
    public function create($data)
    {
        return Delivery::create($data);
    }
    public function get(){
        return Delivery::with('deliverySlot','customerAddress')->get();
    }
    public function getDeliveriesByStatus($status){
        return Delivery::where('status',$status)->with('deliverySlot','customerAddress')->get();

    }
    public function AssignDeliveryBtach($batch_id,$deliveries){
        Delivery::whereIn('id',$deliveries)->update([
            'delivery_batch_id'=>$batch_id,
            'status'=>'ASSIGNED',
        ]);
    }
}
