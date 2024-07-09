<?php

namespace App;

use App\Models\Currency;

class CurrencyHelper
{
    public static function calculate($amount, $rate)
    {
        return round($amount * $rate, 2, PHP_ROUND_HALF_UP);
    }
}
