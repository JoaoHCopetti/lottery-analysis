<?php

namespace App\Http\Controllers;

use App\Enums\LotteriesEnum;
use App\Models\Lottery;
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

        app(LotteryResultsFilter::class)->apply($request, $lotteryResultsQuery);

        $results = $lotteryResultsQuery->orderBy('date', 'desc')->get();
        $numbers = app(NumberDetailsService::class)->getDetailedNumbers($results);

        return Inertia::render('main/MainPage', [
            'results' => $results,
            'numbers' => $numbers
        ]);
    }
}
