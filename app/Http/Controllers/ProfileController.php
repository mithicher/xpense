<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\CheckCurrentPassword;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => ['required', new CheckCurrentPassword],
            'password' => 'required|min:8|confirmed'
        ]);

        $user = auth()->user();

        $user->password = Hash::make($request->password);
        $user->save();

        session()->flash('success', 'Your password has been changed successfully. Please login with your new password next time.');

        return redirect()->back();
    }

    public function updatePersonalDetail(Request $request)
    {
        // dd($request->photo);

        $this->validate($request, [
            'name' => ['required']
        ]);

        if ($request->has('photo')) {
            auth()->user()->update([
                'photo' => $request->photo->store('profiles')
            ]);
        }

        auth()->user()->update([
            'name' => $request->name
        ]);

        session()->flash('success', 'Profile detail updated!');

        return redirect()->back();
    }
}
