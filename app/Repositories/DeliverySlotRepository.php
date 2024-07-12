<?php

namespace App\Repositories;

use App\Interfaces\DeliverySlotInterface;
use App\Models\DeliverySlot;
use Illuminate\Support\Facades\DB;

class DeliverySlotRepository implements DeliverySlotInterface
{
    public function getAllDeliverySlots()
    {
        return DeliverySlot::all();
    }


    public function getAllDeliverySlotsOfCity($city_id)
    {
        return DeliverySlot::where(["city_id" => $city_id, "active_status" => 1])->get();
    }

    public function getAllDeliverySlotsOfCities($cities)
    {
        // return DeliverySlot::selectRaw('TIME_FORMAT(start_time, "%l:%i %p") as start_time')
        // ->selectRaw('TIME_FORMAT(end_time, "%l:%i %p") as end_time')
        // ->where(["city_id" => $city_id, "active_status" => 1])->get();
        return DeliverySlot::whereIn('city_id', $cities)
            ->where('active_status', 1)
            ->get();
    }

    public function addDeliverySlots($start_time, $end_time, $city_id)
    {
        return DeliverySlot::create([
            'start_time' => $start_time,
            'end_time' => $end_time,
            'city_id' => $city_id,
        ]);
    }

    public function getDeliverySlotsByTimeAndCity($start_time, $end_time, $city_id)
    {
        return DeliverySlot::where('start_time', $start_time)
            ->where('end_time', $end_time)
            ->where('city_id', $city_id)
            ->where('active_status', 1)
            ->first();
    }


    // =============================================================================================
    // ===============================  A P I   F U N C T I O N S   ================================
    // =============================================================================================

    public function getAllFormattedDeliverySlots()
    {
        // return DeliverySlot::with('city')->get();
        return DeliverySlot::select(
            'delivery_slots.id as slot_id',
            'delivery_slots.city_id',
            DB::raw("CONCAT(TIME_FORMAT(delivery_slots.start_time, '%h:%i %p'), ' - ', TIME_FORMAT(delivery_slots.end_time, '%h:%i %p'), ' (', cities.name, ')') AS slot")
        )
            ->join('cities', 'delivery_slots.city_id', '=', 'cities.id')
            ->where('delivery_slots.active_status', 1)
            ->whereNull('delivery_slots.deleted_at')
            ->whereNull('cities.deleted_at')
            ->get();
    }
}
