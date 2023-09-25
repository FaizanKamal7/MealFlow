<?php

namespace Modules\DeliveryService\Interfaces;

interface DeliveryInterface
{
    public function create($data);
    public function get();
}
