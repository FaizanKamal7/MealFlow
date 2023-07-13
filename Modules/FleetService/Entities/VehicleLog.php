<?php

namespace Modules\FleetService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_id',
        'driver_id',
        'check_in_time',
        'check_out_time',
        'device_details',
        'checked_out_user',
    ];

    protected static function newFactory()
    {
        return \Modules\FleetService\Database\factories\VehicleLogFactory::new();
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class,'driver_id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class,'vehicle_id');
    }
}