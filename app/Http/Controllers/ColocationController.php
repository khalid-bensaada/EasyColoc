<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationMail;
use Illuminate\Http\Request;
use App\Models\Colocation;
use App\Models\Invitation;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;

class ColocationController extends Controller
{
    public function index()
    {
        $colocations = Colocation::where('owner_id', auth()->id())
            ->where('status', 'active')
            ->latest()
            ->get();

        return view('member.colocations.index', compact('colocations'));
    }

    public function create()
    {
        return view('member.colocations.createForm');
    }

    public function store(Request $request)
    {
        $exists = Colocation::where('owner_id', auth()->id())
            ->where('status', 'active')
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'colocation' => 'You must deactivate your current colocation before creating a new one.'
            ]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'descriptions' => 'nullable|string',
        ]);

        $colocation = Colocation::create([
            'name' => $request->name,
            'descriptions' => $request->descriptions,
            'owner_id' => Auth::id(),
            'status' => 'active',
            'token' => Str::random(12)
        ]);

        $colocation->users()->attach(Auth::id(), [
            'joined_at' => now(),
            'role' => 'Owner'
        ]);

        $user = Auth::user();
        $user->isOwner = true;
        $user->save();

        return redirect()->route('member.colocations.index')
            ->with('success', 'Colocation created and you are now the owner!');
    }
    public function cancel($id)
    {
        $colocation = Colocation::findOrFail($id);

        if (auth()->id() !== $colocation->owner_id) {
            return back()->with('error', 'Not allowed');
        }

        if ($colocation->status !== 'active') {
            return back()->with('error', 'Already deactivated');
        }

        $colocation->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Colocation deactivated');
    }

    public function sendInvitation(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'colocation_id' => 'required|exists:colocations,id'
        ]);

        $colocation = Colocation::findOrFail($request->colocation_id);

        Mail::to($request->email)->send(new InvitationMail($colocation, $colocation->token));

        return back()->with('success', 'Invitation sent successfully to ' . $request->email);
    }

    public function join(Request $request)
    {
        $request->validate([
            'token' => 'required|string'
        ]);

        $colocation = Colocation::where('token', $request->token)->first();

        if (!$colocation) {
            return back()->withErrors([
                'token' => 'Invalid invitation token.'
            ]);
        }


        if ($colocation->users()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('member.colocations.userDash');
        }


        $colocation->users()->attach(auth()->id(), [
            'joined_at' => now(),
            'role' => 'Member'
        ]);

        return redirect()->route('member.colocations.userDash')
            ->with('success', 'Successfully joined colocation.');
    }


    public function showOwnerColoc($id)
    {
        $colocation = Colocation::findOrFail($id);

        $expenses = $colocation->expenses;

        $members = $colocation->users;

        $categories = Categories::all();

        return view('member.colocations.ownercoloc', compact(
            'colocation',
            'expenses',
            'members',
            'categories'
        ));
    }

    public function joinForm()
    {
        return view('member.colocations.joinForm');
    }

    public function userDash()
    {
        $colocation = Colocation::whereHas('users', function ($query) {
            $query->where('user_id', auth()->id());
        })
            ->with(['expenses', 'users'])
            ->first();

        $expenses = $colocation?->expenses ?? collect();
        $members = $colocation?->users ?? collect();
        $categories = Categories::all();

        $sum = Payment::selectRaw("
        users.name as member_name,
        expenses.title as expense_title,
        creator.name as expense_creator,
        payments.id as payment_id,
        payments.debtor_id as zz,
        SUM(payments.amount) as total_owed
    ")
            ->join('users', 'users.id', '=', 'payments.debtor_id')
            ->join('expenses', 'expenses.id', '=', 'payments.expense_id')
            ->join('users as creator', 'creator.id', '=', 'payments.creator_id')
            ->groupBy(
                'users.name',
                'expenses.title',
                'creator.name',
                'payments.id',
                'payments.debtor_id'
            )
            ->get();

        return view('member.colocations.userDash', compact(
            'colocation',
            'expenses',
            'members',
            'categories',
            'sum'
        ));
    }

    public function userDashProcess(Request $request)
    {
        return redirect()->route('member.colocations.userDash');
    }

    public function leave()
    {
        $colocation = Colocation::whereHas('users', function ($query) {
            $query->where('user_id', auth()->id());
        })->first();

        if ($colocation) {
            $colocation->users()->detach(auth()->id());
        }

        return redirect()->route('dashboard');
    }

    public function payExpense(Request $request)
    {
        $payment = Payment::where('id', $request->payment_id)
            ->where('debtor_id', auth()->id())
            ->firstOrFail();

        $payment->delete();

        return back()->with('success', 'Debt cleared successfully');
    }
}
