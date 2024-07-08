<?php

namespace App\Livewire;

use App\Models\Conversions;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CurrencyConversion extends Component
{
    public $availableCurrenties;
    public $selectedCurrency;
    public $amount;
    public $calculated = [];

    public $rules = [
        'selectedCurrency' => 'required',
        'amount' => 'required|numeric'
    ];

    public function mount($availableCurrencies)
    {
        $this->availableCurrenties = $availableCurrencies;
    }

    public function calculate()
    {
        $this->validate();
        $conversions = Conversions::all()->where('from_currencies_id', '=', $this->selectedCurrency);
        foreach ($conversions as $conversion)
        {
            try{
                $this->calculated[$conversion->name] = round($this->amount * $conversion->rate, 2, PHP_ROUND_HALF_UP);
            } catch (\Exception $e) {
                $this->calculated[$conversion->name] = 'N/A';
                Log::error("Error calculating conversion for currency {$conversion->name}:  {$e->getMessage()}");
            }

        }
        $this->render();
    }


    public function render()
    {
        return view('livewire.currency-conversion');
    }
}