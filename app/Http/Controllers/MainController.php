<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Enums\LotteriesEnum;
use Illuminate\Http\Request;
use App\Models\LotteryResult;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
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
        $requestId = hash('sha256', (string) json_encode($request->all()));

        $resultsBuilder = LotteryResult::query()
            ->where('lottery_id', LotteriesEnum::MEGA_SENA->id());

        $resultsBuilderFiltered = app(LotteryResultsFilter::class)
            ->apply($request, $resultsBuilder);

        $results = $resultsBuilderFiltered
            ->clone()
            ->orderByDesc('date')
            ->get();

        /**
         * @var Collection<int, \App\Data\DetailedNumberData>
         */
        $numbers = Cache::remember(
            "detailed-numbers:$requestId",
            now()->addHour(),
            fn() => $this->numberDetailsService->getDetailedNumbers($results)
        );

        $unluckyNumbers = Cache::remember(
            "unlucky-numbers:$requestId",
            now()->addHour(),
            fn() => $this->numberDetailsService->getUnluckyNumbers($numbers)
        );

        $recentIntervalFrequencies = Cache::remember(
            "recent-interval-frequencies:$requestId",
            now()->addHour(),
            fn() => $this->numberDetailsService->getIntervalFrequency(
                $resultsBuilderFiltered
                    ->clone()
                    ->orderBy('date')
                    ->get()
            )
        );

        return Inertia::render('main/MainPage', [
            'results' => $results,
            'numbers' => $numbers,
            'unluckyNumbers' => $unluckyNumbers,
            'recentIntervalFrequencies' => $recentIntervalFrequencies,
            'metadata' => [
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
