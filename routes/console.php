<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('hr:check-expiries', function () {
    $this->call('hr:check-expiries');
})->purpose('Check for expiring documents and create notifications')->daily();
