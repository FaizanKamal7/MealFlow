<?php

namespace Modules\FleetService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleModel extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = [
        'make',
        'model',
        'is_active'

    ];
    
    protected static function newFactory()
    {
        return \Modules\FleetService\Database\factories\VehicleModelFactory::new();
    }
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class,'vehicle_model_id');
    }
}
