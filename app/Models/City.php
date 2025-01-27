<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\BusinessService\Entities\DeliverySlotPricing;
use Modules\BusinessService\Entities\Pricing;
use Modules\BusinessService\Entities\RangePricing;

class City extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'active_status',
        'name',
        'state_id',
        'state_code',
        'country_id',
        'country_code',
        'latitude',
        'longitude',
        'flag',
        'wikiDataId',
    ];

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function delivery_slot_pricings()
    {
        return $this->hasMany(DeliverySlotPricing::class);
    }

    public function deliverySlot()
    {
        return $this->hasMany(DeliverySlot::class);
    }

    public function range_pricings()
    {
        return $this->hasMany(RangePricing::class);
    }
}
