<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function appModel()
    {
        return $this->belongsTo(ApplicationModel::class, "model_id");
    }

    public function permissionRoles()
    {
        return $this->hasMany(RolePermission::class, "permission_id");
    }
}
