<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationModel extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = [
        "app_id",
        "model_name",
        "is_active"
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, "app_id");
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, "model_id");
    }
}
