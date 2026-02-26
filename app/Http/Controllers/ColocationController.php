<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colocation;

use Illuminate\Support\Facades\Auth;

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
