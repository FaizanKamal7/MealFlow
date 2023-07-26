<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverySlot extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [

        "area_id",
        "city_id",
        "start_time",
        "end_time",
        ];


    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

}
