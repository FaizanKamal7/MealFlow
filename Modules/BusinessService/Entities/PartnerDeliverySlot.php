<?php

namespace Modules\BusinessService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartnerDeliverySlot extends Model
{
    use HasFactory;
use HasUuids;
    protected $fillable = [
        "delivery_slot_id", //inherited from logx(core) delivery slots
        "branch_id"
    ];

    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\PartnerDeliverySlotFactory::new();
    }
}
