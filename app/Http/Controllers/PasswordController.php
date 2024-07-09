<?php

namespace App\Http\Controllers;

use App\Mail\resetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function index($reset_token = null)
    {
        if (!$reset_token) {
            return view('auth.reset-password');
        }
        $user = User::where('reset_token', $reset_token)->first();
        return view('auth.reset-password',
            [
                'user' => $user,
            ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', '=', $request->get('email'))->first();
        if (!$user) {
            return redirect()->back()->withErrors('This email is not registered');
        }

        $user->update(['reset_token' => Str::random('64')]);
        try{
//          This can be replaced with a queue job, to avoid blocking the user.
            Mail::to($user->email)->send(new resetPassword($user));
        }catch (\Exception){
            Log::error("Failed to send an email to {$user->email}");
        }


        return redirect()->route('auth.confirmation');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:12|confirmed',
            'password_confirmation' => 'required|min:12|same:password',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
            'reset_token' => null,
        ]);

        return redirect()->route('auth.login');
    }


}
