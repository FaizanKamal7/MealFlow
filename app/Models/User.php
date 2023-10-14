<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Attribute;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\BusinessService\Entities\Business;
use Modules\BusinessService\Entities\BusinessUser;
use Modules\BusinessService\Entities\Customer;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'is_active',
        'is_superuser',
        'last_login',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function userRoles()
    {
        return $this->hasMany(UserRole::class, "user_id");
    }

    public function business_users()
    {
        return $this->hasMany(BusinessUser::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function business()
    {
        return $this->hasOne(Business::class, 'admin_id');
    }

    public function is_admin()
    {
        return $this->business()->exists();
    }
}
