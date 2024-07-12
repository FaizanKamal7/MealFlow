<?php

namespace Modules\BusinessService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessPricing extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'business_id',
        'pricing_id',
    ];

    public function city()
    {
        return $this->belongsTo(Pricing::class, 'pricing_id');
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }


    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\BusinessPricingFactory::new();
    }
}
