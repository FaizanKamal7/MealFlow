<?php

namespace Modules\FleetService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\HRManagement\Entities\Employees;

class Driver extends Model
{
    use HasFactory;
    use HasUuids;
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
    public function employee(){
        return $this->belongsTo(Employees::class,'employee_id');
    }

    public function logs(){
        return $this->hasMany(VehicleLog::class);
    }
    }
