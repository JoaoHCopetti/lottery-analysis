<?php

namespace App\Interfaces;

use App\Enums\LotteriesEnum;
use App\Models\Lottery;

abstract class LotteryFetchAction
{
    public function getLottery(): Lottery
    {
        $lottery = Lottery::query()->find($this->getEnum()->id());

        assert($lottery !== null);

        return $lottery;
    }

    abstract public function getEnum(): LotteriesEnum;
    abstract public function execute(): int;
}
