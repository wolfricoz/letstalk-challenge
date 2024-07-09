<?php

namespace App\Livewire;

use App\Models\IpTable;
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
        $ip = IpTable::create(['ip_address' => $this->newip]);
        $this->ips->push($ip);
        $this->newip = '';
        $this->dispatch('Ipupdated');
    }

    public function removeIp($id)
    {
        $ip = IpTable::find($id);
        $ip->delete();
        $this->ips = $this->ips->where('id', '!=', $id)->values();
        $this->dispatch('Ipupdated');
    }


    public function render()
    {
        return view('livewire.admin-panel');
    }
}
