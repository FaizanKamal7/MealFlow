<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\FleetService\Entities\Driver;

class Area extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'active_status',
        'name',
        'city_id',
        'geoname_id',
        'coordinates',
        'is_deleted',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function drivers()
{
    return $this->belongsToMany(Driver::class, 'driver_areas', 'area_id', 'driver_id');
}
}
