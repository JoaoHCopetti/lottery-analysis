<?php

namespace App\Console\Commands;

use Exception;
use App\Models\Lottery;
use App\Enums\LotteriesEnum;
use Illuminate\Console\Command;
use App\Actions\MegaSena\MegaSenaFetchAction;
use App\Interfaces\LotteryFetchAction;

class FetchLotteryResultsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-lottery {slug? : Slug of lottery to fetch}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data related to a lottery and insert into the database';

    /**
     * @var array<string,class-string>
     */
    protected static $lotteries = [
        LotteriesEnum::MEGA_SENA->value => MegaSenaFetchAction::class
    ];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (!Lottery::query()->count()) {
            $this->error('No lotteries registered');
            return;
        }

        $this->executeFetch($this->getSlug());
    }

    private function executeFetch(string $slug): void
    {
        $this->info("Fetching $slug info...");
        $action = app(static::$lotteries[$slug]);

        if (!$action instanceof LotteryFetchAction) {
            throw new Exception('The action class must extend ' . LotteryFetchAction::class);
        }

        $countNewRecords = $action->execute();

        $this->info("Fetch finished, $countNewRecords new records added.");
    }

    private function getSlug(): string
    {
        $lotteries = Lottery::all();
        $slug = $this->argument('slug');

        if ($slug && $lotteries->pluck('slug')->contains($slug)) {
            return $slug;
        }

        /**
         * @var string
         */
        return $this->choice(
            'Choose a lottery to fetch',
            $lotteries->mapWithKeys(
                fn($lottery) => [$lottery->slug => $lottery->name]
            )->toArray()
        );
    }
}
