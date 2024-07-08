<?php

namespace App\Livewire;

use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $rules = [
        'email' => 'required|email',
        'password' => 'required|min:12',
    ];

    public function render()
    {
        return view('livewire.login');
    }
}
