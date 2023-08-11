<?php

namespace Modules\FinanceService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_holder_name',
        'cvv',
        'expiry_month',
        'expiry_year',
        'wallet_id',
    ];
    
    protected static function newFactory()
    {
        return \Modules\FinanceService\Database\factories\BusinessCardFactory::new();
    }
}
