<?php

namespace App\Livewire;

use App\Models\IpTable;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AdminPanel extends Component
{
    public $ips;
    public $newip;
    public $rules = [
        'newip' => 'required|ip',
    ];
    public $listeners = ['Ipupdated'=>'$refresh'];
    public function mount()
    {
        $this->ips = IpTable::all();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addIp()
    {
        $this->validate();
        Log::info(auth()->user()->name . "added IP: $this->newip");
        $ip = IpTable::create(['ip_address' => $this->newip]);
        $this->ips->push($ip);
        $this->newip = '';
        $this->dispatch('Ipupdated');
    }

    public function removeIp($id)
    {
        $ip = IpTable::find($id);
        $ip->delete();
        Log::info(auth()->user()->name . "removed IP: $ip->ip_address");

        $this->ips = $this->ips->where('id', '!=', $id)->values();
        $this->dispatch('Ipupdated');
    }


    public function render()
    {
        return view('livewire.admin-panel');
    }
}
