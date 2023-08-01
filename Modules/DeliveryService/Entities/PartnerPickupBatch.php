<?php

namespace Modules\DeliveryService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartnerPickupBatch extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        "start_time",
        "departure_time",
        "start_coordinates",
        "departure_coordinates",
        "arrival_time",
        "status",
        "logs",
        "total_items_picked",

        "created_by",
        "branch_id", //Remove this and add an associative entity
        "vehicle_id",
        "driver_id",

    ];

    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\PartnerPickupBatchFactory::new();
    }
}
