<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        "role_name",
        "description",
        "is_active"
    ];

    public function rolePermissions()
    {
        return $this->hasMany(RolePermission::class, "role_id");
    }

    public function roleUsers()
    {
        return $this->hasMany(UserRole::class, "role_id");
    }
}
