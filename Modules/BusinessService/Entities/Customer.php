<?php

namespace Modules\BusinessService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    use HasUuids;
    
    protected $fillable = [
        'name',
        'is_notification_enabled',
        'user_id',
        'is_deleted',
    ];

    public function customerAddresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function businessCustomers()
    {
        return $this->hasMany(BusinessCustomer::class);
    }

    

    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\CustomerFactory::new();
    }
}