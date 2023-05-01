<?php

namespace Modules\UserService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceModel extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = [
        "app_id",
        "model_name",
        "is_active"
    ];

    public function application(){
        return $this->belongsTo(Service::class, "app_id");
    }

    public function permissions(){
        return $this->hasMany(Permission::class, "model_id");
    }
    protected static function newFactory()
    {
        return \Modules\UserService\Database\factories\ServiceModelFactory::new();
    }
}
