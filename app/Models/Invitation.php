<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'email',
        'token',
        'colocation_id',
        'status',
        'accepted_at',
        'refused_at',
        'expires_at'
    ];

    
}
