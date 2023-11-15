<?php

namespace Modules\BusinessService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessCustomer extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'customer_id',
        'business_id',
    ];

    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\BusinessCustomerFactory::new();
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    // public function toArray()
    // {
    //     $array = parent::toArray();
    //     $array['customer'] = $this->customer->toArray();
    //     $array['business'] = $this->business->toArray();

    //     return $array;
    // }
}
