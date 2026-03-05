<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',
            'accommo_id' => 'required|exists:colocations,id',
        ]);

        $colocationId = $request->accommo_id;

        $expense = Expense::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'colocation_id' => $colocationId,
            'date' => now(),
        ]);

        $memberIds = DB::table('colocation_user')
            ->where('colocation_id', $colocationId)
            ->pluck('user_id');

        $count = $memberIds->count();

        $share = 0;

        if ($count > 0) {
            $share = $request->amount / $count;

            foreach ($memberIds as $userId) {
                Payment::create([
                    'expense_id'    => $expense->id,
                    'colocation_id' => $colocationId,
                    'debtor_id'     => $userId,
                    'payer_id'      => auth()->id(),
                    'creator_id'    => auth()->id(),
                    'amount'        => $share,
                    'status'        => ($userId == auth()->id()) ? 'paid' : 'pending',
                ]);
            }
        }

        return back()->with('success', "Expense split! Each of the $count members owes " . number_format($share, 2) . " DH.");
    }

    public function destroy(Expense $expense)
    {

        if ($expense->user_id !== auth()->id()) {
            abort(403);
        }

        $expense->delete();

        return back()->with('success', 'Expense deleted successfully');
    }
}
