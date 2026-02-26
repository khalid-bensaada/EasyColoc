<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colocation;

use Illuminate\Support\Facades\Auth;

class ColocationController extends Controller
{
    public function index()
    {
        $colocations = Auth::user()
            ->colocations()
            ->wherePivot('left_at', null)
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
        $request->validate([
            'name' => 'required|string|max:255',
            'descriptions' => 'nullable|string',
        ]);

        $colocation = Colocation::create([
            'name' => $request->name,
            'descriptions' => $request->description,
            'owner_id' => Auth::id(),
            'status' => 'active',
        ]);

        $colocation->users()->attach(Auth::id(), [
            'joined_at' => now(),
        ]);

        return redirect()->route('member.colocations.index');
    }
}
