<?php

namespace Modules\DeliveryService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BagDropBatchBag extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        "bag_id",
        "bag_drop_batch_id",
    ];


    public function bag()
    {
        return $this->belongsTo(Bag::class, 'bag_id');
    }

    public function bagDropBatch()
    {
        return $this->belongsTo(BagDropBatch::class, 'bag_drop_batch_id');
    }

    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\BagDropBatchBagFactory::new();
    }
}
