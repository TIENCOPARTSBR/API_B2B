<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminConfig extends Model
{
    use HasFactory;
    
    protected $guard = "admin";
    protected $table = "config_admin";
    protected $primary_key = "id";

    protected $fillable = [
        'name',
        'key_name',
        'key_value',
        'updated_at',
    ];
}
