<?php

namespace Modules\BusinessService\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessUser extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'id',
        'user_id',
        'business_id',
        'is_deleted',
    ];

    protected static function newFactory()
    {
        return \Modules\BusinessService\Database\factories\BusinessUserFactory::new();
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
