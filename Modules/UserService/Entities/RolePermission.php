<?php

namespace Modules\UserService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RolePermission extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = [
        "role_id",
        "permission_id"
    ];

    public function role(){
        return $this->belongsTo(Role::class, "role_id");
    }

    public function permission(){
        return $this->belongsTo(Permission::class, "permission_id");
    }
    protected static function newFactory()
    {
        return \Modules\UserService\Database\factories\RolePermissionFactory::new();
    }
}
