<?php

namespace App\Livewire;

use App\Models\Conversions;
use Livewire\Component;

class CurrencyConversion extends Component
{
    public $availableCurrenties;
    public $selectedCurrency;
    public $amount;
    public $calculated = [];

    public function mount($availableCurrencies)
    {
        $this->availableCurrenties = $availableCurrencies;
    }

    public function calculate()
    {
        $conversions = Conversions::where('from_currencies_id', '=', $this->selectedCurrency)->get();
        foreach ($conversions as $conversion)
        {

        }
    }


    public function render()
    {
        return view('livewire.currency-conversion');
    }
}
