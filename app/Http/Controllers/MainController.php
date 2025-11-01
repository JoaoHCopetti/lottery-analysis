<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Enums\LotteriesEnum;
use Illuminate\Http\Request;
use App\Models\LotteryResult;
use App\Services\NumberDetailsService;
use App\Http\Filters\LotteryResultsFilter;

class MainController extends Controller
{
    public function __construct(
        private NumberDetailsService $numberDetailsService
    ) {
        //
    }

    /**
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $intervalFrequenciesLimit = now()->subMonths(2);
        $resultsBuilder = LotteryResult::query()
            ->where('lottery_id', LotteriesEnum::MEGA_SENA->id());

        $resultsBuilderFiltered = app(LotteryResultsFilter::class)
            ->apply($request, $resultsBuilder);

        $results = $resultsBuilderFiltered
            ->clone()
            ->orderByDesc('date')
            ->get();

        $numbers = $this->numberDetailsService->getDetailedNumbers($results);

        $unluckyNumbers = $this->numberDetailsService->getUnluckyNumbers($numbers);

        $recentIntervalFrequencies = $this->numberDetailsService->getIntervalFrequency(
            $resultsBuilderFiltered
                ->clone()
                ->orderBy('date')
                ->where('date', '>', $intervalFrequenciesLimit)
                ->get()
        );


        return Inertia::render('main/MainPage', [
            'results' => $results,
            'numbers' => $numbers,
            'unluckyNumbers' => $unluckyNumbers,
            'recentIntervalFrequencies' => $recentIntervalFrequencies,
            'metadata' => [
                'intervalFrequenciesLimit' => $intervalFrequenciesLimit,
                'minDate' =>
                    $resultsBuilder
                        ->clone()
                        ->orderBy('date', 'asc')
                        ->first()
                        ?->date?->format('Y-m-d')
            ]
        ]);
    }
}
