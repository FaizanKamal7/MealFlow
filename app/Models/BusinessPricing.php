<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\BusinessService\Entities\Business;

class BusinessPricing extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'min_range',
        'max_range',
        'range_price',
        'same_loc_range_price',
        'delivery_slot_price',
        'same_loc_delivery_slot_price',
        'is_base_price',
        'active_status',
        'currency',
        'pricing_type',
        'city_id',
        'business_id',
        'delivery_slot_id',
        'deleted_at',
    ];


    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function businesses()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function deliverySlot()
    {
        return $this->belongsTo(DeliverySlot::class, 'delivery_slot_id');
    }
}
