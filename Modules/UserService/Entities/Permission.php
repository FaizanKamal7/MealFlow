<?php

namespace Modules\UserService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = [
        "model_id",
        "name",
        "codename",
        "is_active"
    ];

    public function appModel(){
        return $this->belongsTo(ServiceModel::class, "model_id");
    }

    public function permissionRoles(){
        return $this->hasMany(RolePermission::class, "permission_id");
    }
    protected static function newFactory()
    {
        return \Modules\UserService\Database\factories\PermissionFactory::new();
    }
}
