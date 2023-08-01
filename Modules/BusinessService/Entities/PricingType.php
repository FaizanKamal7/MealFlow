<?php

namespace Modules\BusinessService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PricingType extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "pricing_types";
    protected $fillable = [
        'name',
    ];

    public function pricings()
    {
        return $this->hasMany(Pricing::class);
    }

    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\PricingTypeFactory::new();
    }
}
