<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.show', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|email|max:255'
        ]);
        auth()->user()->update(
            $request->only('name', 'email')
        );

        return back()->with('success', 'profile update');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);
        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('seccess', 'password update');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|iamge|max:3000'
        ]);

        $path = $request->file('photo')->store('profiles', 'public');

        auth()->user()->update([
            'profile_photo_path' => $path
        ]);

        return back()->with('seccesss', 'photo updated');
    }

    public function leaveColocation()
    {
        $user = auth()->user();

        $membership = $user->colocations()
            ->wherePivot('left_at', null)
            ->first();

        if (!$membership) {
            return back()->with('error', 'no active colocation');
        }

        if ($membership->pivot->role == 'owner') {
            return back()->with('error', 'owner cannot leave');
        }

        $user->colocations()->updateExistingPivot(
            $membership->id,
            ['left_at' => now()]
        );

        return back()->with('seccess', 'You left the colocation');
    }

    public function cancelColocation()
    {
        $colocation = \App\Models\Colocation::where('owner_id', auth()->id())
            ->where('status', 'active')
            ->first();

        if (!$colocation) {
            return back()->with('error', 'Not allowed');
        }

        $colocation->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Colocation cancelled');
    }
}
