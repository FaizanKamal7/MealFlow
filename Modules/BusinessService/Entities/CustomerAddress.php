<?php

namespace Modules\BusinessService\Entities;

use App\Models\Area;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
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
        'address_type',
        'address_status',
        'latitude',
        'longitude',
        'area_id',
        'city_id',
        'state_id',
        'country_id',
        'customer_id',
        'is_deleted',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function businessCustomers()
    {
        return $this->belongsTo(Customer::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }


    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\CustomerAddressFactory::new();
    }
}
