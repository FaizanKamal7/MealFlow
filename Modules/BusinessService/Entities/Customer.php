<?php

namespace Modules\BusinessService\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'is_notification_enabled',
        'user_id',
        'is_deleted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customerAddresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function businessCustomers()
    {
        return $this->hasMany(BusinessCustomer::class);
    }

    public function secondaryNumbers()
    {
        return $this->hasMany(CustomerSecondaryNumber::class);
    }


    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\CustomerFactory::new();
    }
}
