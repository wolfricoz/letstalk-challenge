<?php

namespace App\authentication;

use App\Models\IpTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class Authenticate
{
    public User|null $user;
    public Request $request;

    public function __construct($user, $request)
    {
        $this->user = $user;
        $this->request = $request;
    }
    public function createUser(array $data)
    {
        $this->user = User::create($data);
        return $this;
    }

    public function ipCheck()
    {
        if(!IpTable::check($this->request->ip())){
            Log::info('Unauthorized IP: ' . $this->request->ip());
            return redirect()->back()->withErrors('IP_NOT_AUTHORIZED');
        }
        return $this;
    }


    public function loginUser()
    {


        auth()->login($this->user, $this->request->has('remember'));
    }

    public static function checkIp(Request $request)
    {
        $instance = new self(null, $request);
        $instance->ipCheck($request);
        return $instance;
    }

    public static function create(array $data, Request $request)
    {
        $instance = new self(null, $request);
        $instance->createUser($data);
        return $instance;
    }

    public static function login(Request $request, $user)
    {

        $instance = new self($user, $request);
        $instance->loginUser();
        return $instance;
    }
}
