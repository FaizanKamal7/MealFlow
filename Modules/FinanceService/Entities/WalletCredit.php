<?php

namespace Modules\FinanceService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WalletCredit extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'transaction_date',
        'payment_method',
        'wallet_id',
        'card_id',
    ];
    
    protected static function newFactory()
    {
        return \Modules\FinanceService\Database\factories\WalletCreditFactory::new();
    }
}
