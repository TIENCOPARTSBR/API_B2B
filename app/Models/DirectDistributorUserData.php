<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class DirectDistributorUserData extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $table = "direct_distributor_user_data";
    protected $guard = "direct-distributor";
    protected $primary_key = "id";

    protected $fillable = [
        'type',
        'name',
        'email',
        'password',
        'token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
