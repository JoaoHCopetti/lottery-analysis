<?php

namespace App\Interfaces;

interface LotteryFetchActionInterface
{
    public function execute(string $lotterySlug): int;
}
