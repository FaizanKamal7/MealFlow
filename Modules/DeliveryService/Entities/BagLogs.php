<?php

namespace Modules\DeliveryService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BagLogs extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        "bag_id",
        "previous_status",
        "current_status",
        "description"
    ];

    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\BagLogsFactory::new();
    }

    public function bag(){
        return $this->belongsTo(Bags::class);
    }
}
