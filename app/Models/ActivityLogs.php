<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLogs extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        "module_name",
        "action",
        "subject",
        "url",
        "description",
        "ip_address",
        "user_agent",
        "old_values",
        "new_values",
        "record_id",
        "record_type",
        "method",

        "user_id"
    ];


}