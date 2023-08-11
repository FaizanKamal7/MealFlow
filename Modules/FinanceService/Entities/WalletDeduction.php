<?php

namespace Modules\FinanceService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WalletDeduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'transaction_date',
        'wallet_id',
        'invoice_item_id',
    ];

    protected static function newFactory()
    {
        return \Modules\FinanceService\Database\factories\WalletDeductionFactory::new();
    }
}