<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
Artisan::command('currency:update', function () {
    $this->comment('Updating currencies');
})->purpose('Update currencies')->at('01:00')->at('13:00');
