<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function index($id = null, $reset_token = null)
    {
        $user = User::find($id);
        if ($reset_token && !$user->reset_token == $reset_token) {
            $user = null;
        }
        return view('auth.reset-password',
            [
                '$user' => $user
            ]);
    }

}
