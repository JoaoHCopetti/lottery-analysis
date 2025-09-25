<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\FetchLotteryResultsCommand;

Schedule::command(FetchLotteryResultsCommand::class, ['mega-sena'])
    ->hourly()
    ->after(function () {
        Cache::forget('mega-sena:numbers');
    });
