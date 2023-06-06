<?php

namespace Modules\FleetService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_number',
        'experience',
        'is_available',
        'license_document',
        'license_expiry_date',
        'employee_id',

    ];

    protected static function newFactory()
    {
        return \Modules\FleetService\Database\factories\DriverFactory::new();
    }
}
