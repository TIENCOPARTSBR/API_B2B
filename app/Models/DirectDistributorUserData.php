<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectDistributorUserData extends Model
{
    use HasFactory;

    protected $table = "direct_distributor_user_data";
    protected $guard = "directDistributor";
    protected $primary_key = "id";

    protected $fillable = [
        'type',
        'name',
        'email',
        'password',
        'token',
        'remember_token',
    ];
}
