<?php

namespace Modules\BusinessService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessCategory extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name',
    ];

    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\BusinessCategoryFactory::new();
    }

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}
