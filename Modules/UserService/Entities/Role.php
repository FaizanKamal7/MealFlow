<?php

namespace Modules\UserService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    protected static function newFactory()
    {
        return \Modules\UserService\Database\factories\RoleFactory::new();
    }
}
