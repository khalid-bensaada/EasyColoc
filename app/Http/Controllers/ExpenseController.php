<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense; 
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category' => 'required',
            
        ]);

        
        Expense::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'category_id' => $request->category,
            'user_id' => Auth::id(), 
            'colocation_id' => $request->accommo_id, 
            'date' => $request->date ?? now(),
        ]);

        
        return back()->with('success', 'Expense added');
    }
}