<?php

namespace Modules\FleetService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
