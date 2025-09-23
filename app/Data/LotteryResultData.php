<?php

namespace App\Data;

class LotteryResultData extends DataTransferObject
{
    public function __construct(
        public string $id,

        /** @var array<string> */
        public array $numbers,
        public string $date
    ) {
        //
    }
}
