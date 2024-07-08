<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Conversions extends Model
{
    protected $guarded = [];

    public function from_currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'from_currencies_id', 'id');
    }

    public function to_currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'to_currencies_id', 'id');
    }

}
