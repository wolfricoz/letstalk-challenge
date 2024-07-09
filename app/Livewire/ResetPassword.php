<?php

namespace App\Livewire;

use Livewire\Component;

class ResetPassword extends Component
{
    public $password;
    public $password_confirmation;
    public $user;
    public $rules = [
        'password' => 'required|min:12',
        'password_confirmation' => 'required|min:12|same:password',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function mount($user)
    {
        $this->user = $user;
    }
    public function render()
    {
        return view('livewire.reset-password');
    }
}
