<?php

namespace Modules\DeliveryService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryImages extends Model
{
    use HasFactory;
use HasUuids;
    protected $fillable = [
        "delivery_id",
        "image_url",
        "image_type",
        "note"
    ];

    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\DeliveryImagesFactory::new();
    }
}
