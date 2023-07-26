<?php

namespace App\Interfaces;

interface DeliverySlotInterface
{
    public function getAllDeliverySlots();
    public function addDeliverySlots($start_time, $end_time, $city_id);
}
