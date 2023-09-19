<?php

namespace Modules\DeliveryService\Interfaces;

interface DeliveryTypeInterface
{
    public function get();
    public function getWhereFirst($where);
}
