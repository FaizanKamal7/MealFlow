<?php

namespace Modules\FleetService\Entities;

use App\Models\Area;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DriverArea extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'id',
        'driver_id',
        'area_id',
    ];

    protected static function newFactory()
    {
        return \Modules\FleetService\Database\factories\DriverAreaFactory::new();
    }

    public function driver(){
        return $this->belongsTo(Driver::class);
    }
    public function area(){
        return $this->belongsTo(Area::class);
    }
    
}
