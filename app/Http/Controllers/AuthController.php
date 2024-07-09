<?php

namespace App\Http\Controllers;

use App\authentication\Authenticate;
use App\Http\Middleware\auth;
use App\Models\IpTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }

    public function authenticate(Request $request)
    {

        if(!IpTable::check($request->ip())){
            Log::info('Unauthorized IP: ' . $request->ip());
            return redirect()->back()->withErrors('IP_NOT_AUTHORIZED');
        }

        $logindata =  $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:12',
        ]);
        $user = User::where('email', $logindata['email'])->first();
        if ($user && hash::check($logindata['password'], $user->password)) {
            auth()->login($user);
            return redirect()->route('home');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records. ',
        ]);
    }

    public function store(Request $request)
    {

        $userdata =  $request->validate([
            'name' => 'required|min:6',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:12|confirmed',
            'password_confirmation' => 'required|min:12|same:password',
        ]);

        Authenticate::checkIp($request)->createUser($userdata)->loginUser();


        return redirect()->route('home');
    }



}
