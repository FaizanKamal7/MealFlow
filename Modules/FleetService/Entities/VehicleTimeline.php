<?php

namespace Modules\FleetService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleTimeline extends Model
{
    use HasFactory;
    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'vehicle_id',
        'driver_id',
        'check_in_time',
        'check_out_time',
        'device_details',
        'checked_out_user',
    ];

    /**
     * Summary of newFactory
     * @return mixed
     */
    protected static function newFactory()
    {
        return \Modules\FleetService\Database\factories\VehicleLogFactory::new();
    }

    /**
     * Summary of driver
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class,'driver_id');
    }
    /**
     * Summary of vehicle
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class,'vehicle_id');
    }
}