<?php

namespace Modules\DeliveryService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryBag extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        "bag_id",
        "delivery_id",
    ];

    public function bag()
    {
        return $this->belongsTo(Bag::class, 'bag_id');
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }

    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\DeliveryBagFactory::new();
    }
}
