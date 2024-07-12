<?php

namespace App\Interfaces;

interface DeliverySlotInterface
{
    public function getAllDeliverySlots();
    public function getAllDeliverySlotsOfCity($city_id);
    public function addDeliverySlots($start_time, $end_time, $city_id);
    public function getAllDeliverySlotsOfCities($cities);
    public function getDeliverySlotsByTimeAndCity($start_time, $end_time, $city_id);
    public function getAllFormattedDeliverySlots();
}
