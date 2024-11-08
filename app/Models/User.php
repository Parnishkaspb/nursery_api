<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'telephone',
        'login',
        'password',
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
        'password' => 'hashed',
    ];

    /**
     * Хешировать пароль
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        if ($value !== null && $value !== '') {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function workWithMoneys()
    {
        return $this->hasMany(WorkWithMoney::class, 'id_user');
    }

    public function moneys()
    {
        return $this->hasMany(UserMoney::class, 'id_user');
    }
}
