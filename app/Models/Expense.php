<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable =
    [
        'title',
        'amount',
        'category',
        'user_id',
        'colocation_id',
        'date'
    ];
}
