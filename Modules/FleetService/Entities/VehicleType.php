<?php

namespace Modules\FleetService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleType extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = [
        'name',
        'capacity',
        'is_Active'
    ];
    
    public function vehicles()
    {
        $this->hasMany(Vehicles::class,'vehicle_type_id');
    }
    protected static function newFactory()
    {
        return \Modules\FleetService\Database\factories\VehicleTypeFactory::new();
    }
    
}
