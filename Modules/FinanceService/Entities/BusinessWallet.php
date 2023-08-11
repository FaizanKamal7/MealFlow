<?php

namespace Modules\FinanceService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessWallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'balance',
        'business_id',
    ];
    
    protected static function newFactory()
    {
        return \Modules\FinanceService\Database\factories\BusinessWalletFactory::new();
    }
}
