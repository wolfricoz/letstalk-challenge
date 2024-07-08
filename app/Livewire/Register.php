<?php

namespace App\Livewire;

use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:12',
        'password_confirmation' => 'required|min:12|same:password',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->name = old('name');
        $this->email = old('email');
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function render()
    {
        return view('livewire.register');
    }
}
