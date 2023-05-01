<?php

namespace Modules\UserService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        "app_icon",
        "app_name",
        "description",
        "menu",
        "logs",
        "previous_version",
        "current_version",
        "is_active",
    ];


    public function models()
    {
        return $this->hasMany(ServiceModel::class);
    }
    protected static function newFactory()
    {
        return \Modules\UserService\Database\factories\ServiceFactory::new();
    }
}
