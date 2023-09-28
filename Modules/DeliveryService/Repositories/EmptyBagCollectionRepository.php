<?php

namespace Modules\DeliveryService\Repositories;

use Modules\DeliveryService\Entities\EmptyBagCollection;
use Modules\DeliveryService\Interfaces\EmptyBagCollectionInterface;

class EmptyBagCollectionRepository implements EmptyBagCollectionInterface
{

    public function createBagCollection($data){
       return EmptyBagCollection::create($data);
    }
}