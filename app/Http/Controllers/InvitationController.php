<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Invitation;
use App\Models\Colocation;
use App\Mail\InvitationMail;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'colocation_id' => 'required|exists:colocations,id'
        ]);

        $colocation = Colocation::findOrFail($request->colocation_id);

        if ($colocation->owner_id !== auth()->id()) {
            return back()->with('error', 'Not allowed');
        }

        if ($colocation->status !== 'active') {
            return back()->with('error', 'Colocation not active');
        }

        $token = Str::random(12);

        $invitation = Invitation::create([
            'email' => $request->email,
            'token' => $token,
            'colocation_id' => $colocation->id,
            'created_at' => now()
        ]);

        Mail::to($request->email)->send(new InvitationMail($invitation));

        return back()->with('success', 'Invitation sent successfully');
    }

    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();

        if ($invitation->accepted_at || $invitation->refused_at) {
            return redirect('/')->with('error', 'Invitation already used');
        }

        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }

        $hasActiveMembership = $user->colocations()
            ->wherePivot('left_at', null)
            ->exists();

        if ($hasActiveMembership) {
            return redirect('/')->with('error', 'You already have active colocation');
        }

        $user->colocations()->attach($invitation->colocation_id, [
            'role' => 'member',
            'joined_at' => now()
        ]);

        $invitation->update([
            'accepted_at' => now()
        ]);

        return redirect()->route('member.colocations.index')
            ->with('success', 'Invitation accepted');
    }

    public function refuse($token)
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();

        $invitation->update([
            'refused_at' => now()
        ]);

        return redirect('/')->with('success', 'Invitation refused');
    }
}
