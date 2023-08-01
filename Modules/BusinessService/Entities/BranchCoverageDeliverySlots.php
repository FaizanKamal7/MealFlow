<?php

namespace Modules\BusinessService\Entities;

use App\Models\DeliverySlot;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BranchCoverageDeliverySlots extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'branch_coverage_delivery_slots';
    protected $fillable = [
        'branch_coverage_id',
        'delivery_slot_id',
    ];

    public function delivery_slot()
    {
        return $this->belongsTo(DeliverySlot::class);
    }

    public function branch_coverages()
    {
        return $this->belongsTo(BranchCoverage::class);
    }

    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\BranchCoverageDeliverySlotsFactory::new();
    }
}
