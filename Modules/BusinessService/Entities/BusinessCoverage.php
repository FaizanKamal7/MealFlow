<?php

namespace Modules\BusinessService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessCoverage extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\BusinessCoverageFactory::new();
    }
}
