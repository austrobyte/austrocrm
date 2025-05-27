<?php

namespace Austro\Crm\Models;

use Illuminate\Database\Eloquent\Model;

class AustroCrmToken extends Model
{
    protected $table = 'austro_crm_token';

    protected $fillable = [
        'client_id',
        'client_secret',
        'access_token',
        'unified_token',
        'expiry_time',
        'status',

    ];
}
