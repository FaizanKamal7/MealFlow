<?php

namespace Modules\FleetService\Entities;

use App\Models\Area;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\DeliveryService\Entities\Delivery;
use Modules\DeliveryService\Entities\DeliveryBatch;
use Modules\HRManagement\Entities\Employees;

class Driver extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'license_number',
        'is_available',
        'license_document',
        'license_issue_date',
        'license_expiry_date',
        'employee_id',

    ];

    protected static function newFactory()
    {
        return \Modules\FleetService\Database\factories\DriverFactory::new();
    }
    public function employee()
    {
        return $this->belongsTo(Employees::class, 'employee_id');
    }
    public function user()
    {
        return $this->hasOneThrough(Employees::class,User::class);
    }
    public function timelines()
    {
        return $this->hasMany(VehicleTimeline::class);
    }
    public function lastIncompleteTimeline()
    {
        // return $this->hasOne(VehicleTimeline::class)->ofMany(
        //     [
        //         'created_at','max',
        //     ],function (Builder $query){
        //         $query->whereNull("check_out_time");
        //     }
        // );
        return $this->hasOne(VehicleTimeline::class)
            ->orderBy('created_at', 'desc')
            ->whereNull('check_out_time');
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class, 'driver_areas', 'driver_id', 'area_id');
    }


    public function deliveries()
    {
        return $this->hasManyThrough(Delivery::class, DeliveryBatch::class);
    }

}