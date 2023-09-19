<?php

namespace Modules\DeliveryService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        "name"
    ];

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }



    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\DeliveryStatusFactory::new();
    }
}
