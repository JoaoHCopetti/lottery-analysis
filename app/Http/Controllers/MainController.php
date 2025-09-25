<?php

namespace App\Http\Controllers;

use App\Actions\MegaSenaFetchAction;
use App\Enums\LotteriesEnum;
use App\Models\Lottery;
use App\Services\NumberDetailsService;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class MainController extends Controller
{
    /**
     * @return \Inertia\Response
     */
    public function index()
    {
        $lottery = Lottery::find(LotteriesEnum::MEGA_SENA->id());

        assert($lottery !== null);

        $results = $lottery->results()->where('date', '>', '2009-01-01')->get();
        $numbers = app(NumberDetailsService::class)->getDetailedNumbers($results);

        return Inertia::render('main/MainPage', [
            'results' => $results,
            'numbers' => $numbers
        ]);
    }
}
