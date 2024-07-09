<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class RequestReset extends Component
{
    public $email;
    public $rules = [
        'email' => 'email|required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }



    public function render()
    {
        return view('livewire.request-reset');
    }
}
