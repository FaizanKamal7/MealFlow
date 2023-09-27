<?php

namespace Modules\DeliveryService\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\FleetService\Entities\Vehicle;

class DeliveryTimeline extends Model
{
    use HasFactory;

    protected $fillable = [
        "delivery_id",
        "status_id",
        "action_by",
        "vehicle_id",
        "description",
    ];

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }

    public function deliveryStatus()
    {
        return $this->belongsTo(DeliveryStatus::class, 'status_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'action_by');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\DeliveryTimelineFactory::new();
    }
}
