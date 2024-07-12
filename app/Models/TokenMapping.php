<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenMapping extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'short_token',
        'user_id',
        'passport_token_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
