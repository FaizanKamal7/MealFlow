<?php

namespace Modules\BusinessService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerAddress extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'id',
        'address',
        'area_name',
        'city_name',
        'state_name',
        'country_name',
        'address_type',
        'google_coordinates',
        'area_id',
        'city_id',
        'state_id',
        'country_id',
        'branch_id',
        'is_deleted',
    ];

    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\CustomerAddressFactory::new();
    }


    public function businessCustomers()
    {
        return $this->belongsTo(Customer::class);
    }
}
