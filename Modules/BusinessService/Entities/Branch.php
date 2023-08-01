<?php

namespace Modules\BusinessService\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'active_status',
        'is_main_branch',
        'business_id',
        'area_id',
        'city_id',
        'state_id',
        'country_id',
        'is_deleted',
    ];


    public function business()
    {
        return $this->belongsTo(Business::class);
    }


    public function branch_coverages()
    {
        return $this->hasMany(BranchCoverage::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }


    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\BranchFactory::new();
    }
}
