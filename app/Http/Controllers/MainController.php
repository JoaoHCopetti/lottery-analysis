<?php

namespace App\Http\Controllers;

use App\Enums\LotteriesEnum;
use App\Models\Lottery;
use App\Services\NumberDetailsService;
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

        $results = $lottery->results()->get();
        $numbers = app(NumberDetailsService::class)->getDetailedNumbers($results);

        return Inertia::render('main/MainPage', [
            'results' => $results,
            'numbers' => $numbers
        ]);
    }
}
