<?php

namespace App\Http\Controllers;

use App\Services\HeatmapService;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use App\Services\MegaSenaService;

class MainController extends Controller
{
    public function index()
    {
        $results = Cache::remember('mega-sena:results', 3600, fn () => app(MegaSenaService::class)->getResults());
        $heatmapNumbers = Cache::remember('mega-sena:heatmap', 3600, fn () => app(HeatmapService::class)->getResultsHeatmap($results));

        return Inertia::render('main/MainPage', [
            'results' => $results,
            'heatmap-numbers' => $heatmapNumbers
        ]);
    }
}
