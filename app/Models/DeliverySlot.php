<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\BusinessService\Entities\Pricing;

class DeliverySlot extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'start_time',
        'end_time',
        'active_status',
        'city_id',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function pricings()
    {
        return $this->hasMany(Pricing::class);
    }
}
