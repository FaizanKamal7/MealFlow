<?php

namespace Modules\DeliveryService\Repositories;

use Modules\DeliveryService\Entities\Bags;
use Modules\DeliveryService\Interfaces\BagsInterface;

class BagsRepository implements BagsInterface
{

    public function addNewBag($partner_id,$qrCode, $bagNumber, $bagSize, $bagType, $weight, $dimensions, $status = "Available")
    {
        $bag = new Bags([
            "partner_id"=>$partner_id,
            "qr_code" => $qrCode,
            "bag_number" => $bagNumber,
            "bag_size" => $bagSize,
            "bag_type" => $bagType,
            "status" => $status,
            "weight" => $weight,
            "dimensions" => $dimensions,
        ]);

        $bag->save();
        return $bag;
    }

    public function updateBag($id, $partner_id,$qrCode, $bagNumber, $bagSize, $bagType, $status, $weight, $dimensions)
    {
        return Bags::where(["id" => $id])->update([
            "partner_id"=>$partner_id,
            "bag_number" => $bagNumber,
            "bag_size" => $bagSize,
            "bag_type" => $bagType,
            "status" => $status,
            "weight" => $weight,
            "dimensions" => $dimensions,
        ]);
    }

    public function getBag($id)
    {
        return Bags::where(["id"=>$id])->first();
    }

    public function deleteBag($id)
    {
        return Bags::where(["id"=>$id])->delete();
    }

    public function getBags()
    {
        return Bags::all();
    }

    public function filterBags($status)
    {
        return Bags::where(["status"=>$status])->get();
    }
}
