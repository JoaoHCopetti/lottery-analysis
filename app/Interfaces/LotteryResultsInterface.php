<?php

namespace App\Interfaces;

use App\Data\LotteryResultData;
use Illuminate\Support\Collection;

interface LotteryResultsInterface
{
    /**
     * @return \Illuminate\Support\Collection<int,LotteryResultData>
     */
    public function getResults(): Collection;
}
