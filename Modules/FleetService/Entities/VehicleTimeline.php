<?php

namespace Modules\FleetService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\FleetService\Database\factories\VehicleTimelinesFactory;
use Modules\HRManagement\Entities\Employees;

class VehicleTimeline extends Model
{
    use HasFactory;
    use HasUuids;
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
        return VehicleTimelinesFactory::new();
    }
    /**
     * Summary of driver
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class,'driver_id');
    }
    public function employee(){
        return $this->hasOneThrough(Driver::class,Employees::class);
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