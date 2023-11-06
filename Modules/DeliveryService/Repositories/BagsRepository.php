<?php

namespace Modules\DeliveryService\Repositories;

use Modules\DeliveryService\Entities\Bag;
use Modules\DeliveryService\Interfaces\BagsInterface;

class BagsRepository implements BagsInterface
{

    public function addNewBag($business_id, $qrCode, $bagNumber, $bagSize, $bagType, $weight, $dimensions, $status = null)
    {
        $bag = Bag::create([
            "business_id" => $business_id,
            "qr_code" => $qrCode,
            "bag_number" => $bagNumber,
            "bag_size" => $bagSize,
            "bag_type" => $bagType,
            "status" => $status,
            "weight" => $weight,
            "dimensions" => $dimensions,
        ]);

        return $bag;
    }

    public function updateBag($id, $business_id, $qrCode, $bagNumber, $bagSize, $bagType, $status, $weight, $dimensions)
    {
        return Bag::where(["id" => $id])->update([
            "business_id" => $business_id,
            "qr_code" => $qrCode,
            "bag_number" => $bagNumber,
            "bag_size" => $bagSize,
            "bag_type" => $bagType,
            "status" => $status,
            "weight" => $weight,
            "dimensions" => $dimensions,
        ]);
    }

    public function updateStatus($id, $status)
    {
        $bag = Bag::find($id);
        $bag->status = $status;
        $bag->save();
    }

    public function getBag($id)
    {
        return Bag::where(["id" => $id])->first();
    }

    public function deleteBag($id)
    {
        return Bag::where(["id" => $id])->delete();
    }

    public function getBags()
    {
        return Bag::all();
    }

    public function filterBags($status)
    {
        return Bag::where(["status" => $status])->get();
    }
}
