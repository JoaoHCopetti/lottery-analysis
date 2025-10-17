<?php

namespace App\Http\Controllers;

use App\Enums\LotteriesEnum;
use App\Models\LotteryResult;
use App\Services\NumberDetailsService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Filters\LotteryResultsFilter;

class MainController extends Controller
{
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
        $numbers = app(NumberDetailsService::class)->getDetailedNumbers($results);

        return Inertia::render('main/MainPage', [
            'results' => $results,
            'numbers' => $numbers,
            'metadata' => [
                'min_date' => $lotteryResultsQuery->orderBy('date', 'asc')
                    ->first()?->date?->format('Y-m-d') ?? '1900-01-01'
            ]
        ]);
    }
}
