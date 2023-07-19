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
        'is_deleted',
    ];

    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\BranchFactory::new();
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }


    public function branch_coverages()
    {
        return $this->hasMany(BranchCoverage::class);
    }
}
