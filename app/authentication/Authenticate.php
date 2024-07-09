<?php

namespace App\authentication;

use App\Models\IpTable;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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

    public function createUser(array $data): static
    {
        $this->user = User::create($data);
        Log::info('User created: ' . $this->user->name);
        return $this;
    }

    public function ipCheck(): static|RedirectResponse
    {
        if (!IpTable::check($this->request->ip())) {
            Log::info('Unauthorized IP: ' . $this->request->ip());
            return redirect()->back()->withErrors('IP_NOT_AUTHORIZED');
        }
        return $this;
    }

    public function getUser($email, $password)
    {
        $user = User::where('email', $email)->first();
        if ($user && hash::check($password, $user->password)) {
            $this->user = $user;
            return $this;
        }
        Log::info('Failed login, couldnt get user: ' . $this->request->ip());
        return $this;
    }

    public function loginUser(User|null $user = null)
    {
        if ($user) {
            $this->user = $user;
        }
        if (!$this->user)
        {
            return false;
        }
        auth()->login($this->user, $this->request->has('remember'));
        return true;
    }
// Statis functions start here.
    public static function checkIp(Request $request): static
    {
        $instance = new self(null, $request);
        $instance->ipCheck();
        return $instance;
    }

    public static function create(array $data, Request $request): static
    {
        $instance = new self(null, $request);
        $instance->createUser($data);
        return $instance;
    }

    public static function login(Request $request, $user): bool
    {

        $instance = new self($user, $request);
        return $instance->loginUser();

    }
}
