<?php

namespace Modules\FleetService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DriverArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'area_id',
    ];

    protected static function newFactory()
    {
        return \Modules\FleetService\Database\factories\DriverAreaFactory::new();
    }
}
