<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;

class Expense extends Model
{
    protected $fillable =
    [
        'title',
        'amount',
        'category_id',
        'user_id',
        'colocation_id',
        'date'
    ];

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
