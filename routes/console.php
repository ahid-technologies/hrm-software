<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('hr:check-expiries', function () {
    $this->call('hr:check-expiries');
})->purpose('Check for expiring documents and create notifications')->daily();
