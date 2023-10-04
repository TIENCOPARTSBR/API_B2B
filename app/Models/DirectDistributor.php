<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectDistributor extends Model
{
    use HasFactory;

    protected $guard = "admin";
    protected $table = "direct_distributor";
    protected $primary_key = "id";

    protected $fillable = [
        'name',
        'allow_quotation',
        'allow_partner',
        'sisrev_brazil_code',
        'sisrev_eua_code'
    ];
}
