<?php

namespace Modules\DeliveryService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BagStatuses extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = [
        "name"
    ];
    
    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\BagStatusFactory::new();
    }
}
