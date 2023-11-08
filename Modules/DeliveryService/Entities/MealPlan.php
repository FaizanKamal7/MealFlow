<?php

namespace Modules\DeliveryService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\BusinessService\Entities\Business;

class MealPlan extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        "start_date",
        "end_date",
        "status",
        "skip_days",
        "customer_id",
        "business_id",

    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function customer()
    {
        return $this->belongsTo(Driver::class, 'customer_id');
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['business'] = $this->business->toArray();
        $array['customer'] = $this->customer->toArray();

        return $array;
    }


    protected static function newFactory()
    {
        return \Modules\DeliveryService\Database\factories\MealPlanFactory::new();
    }
}
