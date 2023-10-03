<?php

namespace Modules\DeliveryService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PickupBatch extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        "batch_start_time",
        "batch_end_time",
        "batch_arrival_map_coordinates",
        "batch_end_map_coordinates",
        "status",
        "vehicle_id",
        "driver_id",
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function pickupBatchBranches()
    {
        return $this->hasMany(PickupBatchBranch::class);
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\PickupBatchFactory::new();
    }
}
