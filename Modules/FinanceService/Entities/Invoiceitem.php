<?php

namespace Modules\FinanceService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoiceitem extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\FinanceService\Database\factories\InvoiceitemFactory::new();
    }
}
