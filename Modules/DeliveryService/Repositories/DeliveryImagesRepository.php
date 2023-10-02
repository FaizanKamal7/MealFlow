<?php

namespace Modules\DeliveryService\Repositories;

use Modules\DeliveryService\Entities\DeliveryImages;
use Modules\DeliveryService\Interfaces\DeliveryImagesInterface;



class DeliveryImagesRepository implements DeliveryImagesInterface
{
    public function create($data){
        return DeliveryImages::create($data);
    }
}