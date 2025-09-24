<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FetchLotteryResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-lottery-results';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch lottery results and insert into the database';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
