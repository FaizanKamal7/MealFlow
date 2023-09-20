<?php

namespace Modules\BusinessService\Entities;

use App\Models\City;
use App\Models\DeliverySlot;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RangePricing extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'range_pricings';
    protected $fillable = [
        'min_range',
        'max_range',
        'delivery_price',
        'bag_collection_price',
        'cash_collection_price',
        'same_loc_delivery_price',
        'same_loc_bag_collection_price',
        'same_loc_cash_collection_price',
        'active_status',
        'is_same_for_all_services',
        'currency',
        'city_id',
        'business_id',
        'deleted_at',
    ];


    public function businessPricings()
    {
        return $this->hasMany(BusinessPricing::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function deliverySlot()
    {
        return $this->belongsTo(DeliverySlot::class, 'delivery_slot_id');
    }

    public function pricingType()
    {
        return $this->belongsTo(PricingType::class, 'pricing_type_id');
    }

    public function scopeBusinessNull($query)
    {
        return $query->where('business_id', null);
    }

    public function scopeBusinessExist($query, $businessId)
    {
        return $query->where('business_id', $businessId);
    }


    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\PricingFactory::new();
    }
}
