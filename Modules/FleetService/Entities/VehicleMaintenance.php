<?php

namespace Modules\FleetService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleMaintenance extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\FleetService\Database\factories\VehicleMaintenanceFactory::new();
    }
}