<?php

namespace App\Actions;

use App\Interfaces\LotteryFetchActionInterface;
use App\Models\Lottery;
use App\Models\LotteryResult;

class MegaSenaFetchAction implements LotteryFetchActionInterface
{
    /**
     * @return int Number of rows affected
     */
    public function execute(string $lotterySlug): int
    {
        $lottery = Lottery::query()->firstWhere('slug', $lotterySlug);

        if ($lottery === null) {
            throw new \Exception("Lottery with slug '$lotterySlug' not found");
        }

        $xlsxContent = app(MegaSenaFetchXlsxAction::class)->execute();
        $xlsxPath = app(MegaSenaStoreXlsxContentAction::class)->execute($xlsxContent);
        $xlsxData = app(MegaSenaParseXlsxFileAction::class)->execute($xlsxPath);

        return LotteryResult::query()->insertOrIgnore($xlsxData->map(fn ($result) => [
            ...$result,
            'lottery_id' => $lottery->id,
            'numbers' => json_encode($result['numbers'])
        ])->toArray());
    }
}
