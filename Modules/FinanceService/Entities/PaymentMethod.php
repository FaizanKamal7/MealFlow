<?php

namespace Modules\FinanceService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'active_status',
    ];

    public function businessWalletTransactions()
    {
        return $this->hasMany(BusinessWalletTransaction::class);
    }

    protected static function newFactory()
    {
        return \Modules\FinanceService\Database\factories\PaymentMethodFactory::new();
    }
}
