<?php

namespace App\Data;

use Carbon\Carbon;

class LotteryResultData
{
    public function __construct(
        public string $id,
        public array $numbers,
        public string $date
    ) {
        //
    }
}
