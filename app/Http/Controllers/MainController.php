<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Data\LotteryResultData;
use App\Services\HeatmapService;
use App\Services\MegaSenaService;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
{
    /**
     * @return \Inertia\Response
     */
    public function index()
    {
        /**
         * @var \Illuminate\Support\Collection<int, LotteryResultData>
         */
        $results = Cache::remember('mega-sena:results', 3600, fn () => app(MegaSenaService::class)->getResults());

        $heatmapNumbers = Cache::remember('mega-sena:heatmap', 3600, fn () => app(HeatmapService::class)->getResultsHeatmap($results));

        return Inertia::render('main/MainPage', [
            'results' => $results,
            'heatmap-numbers' => $heatmapNumbers
        ]);
    }
}
