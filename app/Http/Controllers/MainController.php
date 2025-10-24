<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Enums\LotteriesEnum;
use Illuminate\Http\Request;
use App\Models\LotteryResult;
use App\Data\DetailedNumberData;
use App\Services\NumberDetailsService;
use App\Http\Filters\LotteryResultsFilter;

class MainController extends Controller
{
    public function __construct(
        protected NumberDetailsService $numberDetailsService
    ) {
        //
    }

    /**
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $lotteryResultsQuery = LotteryResult::query()
            ->where('lottery_id', LotteriesEnum::MEGA_SENA->id());

        $lotteryResultsQueryFiltered = app(LotteryResultsFilter::class)
            ->apply($request, $lotteryResultsQuery);

        $results = $lotteryResultsQueryFiltered->orderBy('date', 'desc')->get();
        $numbers = $this->numberDetailsService->getDetailedNumbers($results);

        return Inertia::render('main/MainPage', [
            'results' => $results,
            'numbers' => $numbers,
            'unluckyNumbers' => $this->numberDetailsService->getUnluckyNumbers($numbers),
            'metadata' => [
                'minDate' => $lotteryResultsQuery->orderBy('date', 'asc')
                    ->first()?->date?->format('Y-m-d') ?? '1900-01-01'
            ]
        ]);
    }
}
