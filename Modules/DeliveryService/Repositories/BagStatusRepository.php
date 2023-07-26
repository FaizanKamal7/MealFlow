<?php

namespace Modules\DeliveryService\Repositories;

use Modules\DeliveryService\Entities\BagStatuses;
use Modules\DeliveryService\Interfaces\BagStatusInterface;



class BagStatusRepository implements BagStatusInterface {

    public function getStatus($name){
        return BagStatuses::where("name", 'LIKE', '%' . $name . '%')->first();
    }
}