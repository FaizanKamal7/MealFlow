<?php

namespace Modules\FinanceService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;
    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\FinanceService\Database\factories\InvoiceFactory::new();
    }
}
