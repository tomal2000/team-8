<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Interfaces\Wallet;
use App\Traits\HasWallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements LaratrustUser, Wallet
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions, HasWallet;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'unique_id',
        'first_name',
        'last_name',
        'father_name',
        'mother_name',
        'id_type',
        'national_id',
        'mobile',
        'email_verified_at',
        'mobile_verified_at',
        'password',
        'balance',
        'is_payment_collector',
        'photo',
        'id_picture',
        'signature',
        'status',
        'password_status',
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
        'mobile_verified_at' => 'datetime',
        'meta' => 'json',
        'password' => 'hashed',
    ];
}
