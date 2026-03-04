<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Colocation extends Model
{
    protected $fillable =
    [
        'name',
        'description',
        'owner_id',
        'status',
        'token',
        'isOwner'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function expenses(): HasMany
    {

        return $this->hasMany(Expense::class);
    }
    public function members(): HasMany
    {
        return $this->hasMany(Member::class, 'colocation_id');
    }
}
