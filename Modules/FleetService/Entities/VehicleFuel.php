<?php

namespace Modules\FleetService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\HRManagement\Entities\Employees;

class VehicleFuel extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'vehicle_id',
        'employee_id',
        'fuel_type',
        'fuel_quantity',
        'fuel_date',
        'fuel_cost',
        'supplier',
        'notes',
        'payment_method',
        'paid_date',
    ];

    protected static function newFactory()
    {
        return \Modules\FleetService\Database\factories\VehicleFuelFactory::new();
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
    public function employee(){
        return $this->belongsTo(Employees::class);
    }
}