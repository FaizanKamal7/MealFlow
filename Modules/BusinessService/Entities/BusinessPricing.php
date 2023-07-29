<?php

namespace Modules\BusinessService\Entities;

use Doctrine\DBAL\Schema\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessPricing extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\BusinessPricingFactory::new();
    }
}
