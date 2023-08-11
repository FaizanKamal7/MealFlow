<?php

namespace Modules\FinanceService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_type',
        'item_id',
        'amount',
        'invoice_id',
    ];
    
    protected static function newFactory()
    {
        return \Modules\FinanceService\Database\factories\InvoiceItemFactory::new();
    }
}
