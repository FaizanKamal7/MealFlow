<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
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
        return $this->hasMany(ApplicationModel::class, 'app_id');
    }

    // Customize JSON Serialization to make sure below relationships are included whenever Customer is converted to an array or JSON
    public function toArray()
    {
        $array = parent::toArray();
        $array['models'] = $this->models->toArray();

        return $array;
    }
}
