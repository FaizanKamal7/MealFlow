<?php

namespace Modules\FinanceService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'invoice_date',
        'total_amount',
        'paid_amount',
        'status',
        'paid_date',
        'payment_method',
        'is_sent',
        'business_id',
    ];
    
    protected static function newFactory()
    {
        return \Modules\FinanceService\Database\factories\InvoiceFactory::new();
    }
}
