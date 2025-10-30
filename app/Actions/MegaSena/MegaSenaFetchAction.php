<?php

namespace App\Actions\MegaSena;

use App\Enums\LotteriesEnum;
use App\Interfaces\LotteryFetchAction;
use App\Models\LotteryResult;

class MegaSenaFetchAction extends LotteryFetchAction
{
    public function getEnum(): LotteriesEnum
    {
        return LotteriesEnum::MEGA_SENA;
    }

    /**
     * @return int Number of rows affected
     */
    public function execute(): int
    {
        $lottery = $this->getLottery();

        $xlsxContent = app(MegaSenaFetchXlsxAction::class)->execute();
        $xlsxPath = app(MegaSenaStoreXlsxContentAction::class)->execute($xlsxContent);
        $xlsxData = app(MegaSenaParseXlsxFileAction::class)->execute($xlsxPath);

        return LotteryResult::query()
            ->insertOrIgnore($xlsxData->map(fn($result) => [
                ...$result,
                'lottery_id' => $lottery->id,
                'numbers' => json_encode($result['numbers'])
            ])->toArray());
    }
}
