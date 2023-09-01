<?php

namespace Modules\DeliveryService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryLog extends Model
{
    use HasFactory;
use HasUuids;
    protected $fillable = [
        "delivery_id",
        "log_type",
        "log_message",
        "logged_by",
        "logged_by_id"
    ];

    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\DeliveryLogFactory::new();
    }
}
