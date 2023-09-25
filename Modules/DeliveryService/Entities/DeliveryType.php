<?php

namespace Modules\DeliveryService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryType extends Model
{
    use HasFactory;

    protected $fillable = [
        "name"
    ];

    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\DeliveryTypeFactory::new();
    }
}
