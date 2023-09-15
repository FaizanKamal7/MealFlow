<?php

namespace Modules\BusinessService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerSecondaryNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'phone',
        'customer_id',
        'deleted_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\CustomerSecondaryNumberFactory::new();
    }
}
