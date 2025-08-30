<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule auto-release escrow command to run daily at 2 AM
Schedule::command('escrow:auto-release')
    ->dailyAt('02:00')
    ->withoutOverlapping()
    ->runInBackground()
    ->emailOutputOnFailure('admin@satelitjasa.com');
