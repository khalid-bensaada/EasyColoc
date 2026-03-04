<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_id',
        'colocation_id',
        'debtor_id',
        'creator_id',
        'payer_id',  
        'amount',
        'status',
    ];

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    public function debtor()
    {
        return $this->belongsTo(User::class, 'debtor_id');
    }

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }
}