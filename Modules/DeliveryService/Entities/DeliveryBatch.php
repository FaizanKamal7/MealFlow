<?php

namespace Modules\DeliveryService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryBatch extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        "departure_time",
        "departure_coordinates",
        "arrival_time",
        "arrival_coordinates",
        "status",
        "logs",
        "total_deliveries_assigned",
        "scheduled_datetime",

        "created_by",
        "vehicle_id",
        "driver_id",
    ];

    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\DeliveryBatchFactory::new();
    }
}
