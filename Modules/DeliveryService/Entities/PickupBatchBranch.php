<?php

namespace Modules\DeliveryService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\BusinessService\Entities\Branch;

class PickupBatchBranch extends Model
{
    use HasFactory;

    protected $fillable = [
        "arrival_time",
        "start_time",
        "end_time",
        "arrival_map_coordinates",
        "start_map_coordinates",
        "end_map_coordinates",
        "branch_id",
        "pick_up_batch_id",
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function pickUpBatch()
    {
        return $this->belongsTo(PickupBatch::class, 'pick_up_batch_id');
    }

    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\PickupBatchBranchFactory::new();
    }
}
