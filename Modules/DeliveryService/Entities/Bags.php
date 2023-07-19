<?php

namespace Modules\DeliveryService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bags extends Model
{
    use HasFactory;
use HasUuids;
    protected $fillable = [
        "qr_code",
        "bag_number",
        "bag_size", //small,medium,large or capacity (5 ltr, 10 ltr)
        "bag_type", // courier bag, backpack, tote bag
        "status", //in transit, delivered, in wearhouse
        "weight",
        "dimensions", //length x width x height

        "business_id"
    ];

    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\BagsFactory::new();
    }

    public function bagLogs(){
        return $this->hasMany(BagLogs::class, "bag_id");
    }
}
