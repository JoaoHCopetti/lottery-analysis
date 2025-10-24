<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Models\LotteryResult;
use App\Data\DetailedNumberData;
use Illuminate\Support\Collection;

class NumberDetailsService
{
    /**
     * @param Collection<int, \App\Models\LotteryResult> $results
     * @return Collection<int, \App\Data\DetailedNumberData>
     */
    public function getDetailedNumbers(Collection $results)
    {
        /**
         * @var array<string,int>
         */
        $numbers = Arr::mapWithKeys(range(0, 59), fn(int $index) => [$index + 1 => 0]);
        $resultNumbers = $results->pluck('numbers')->collapse()->values();
        $resultsSortedByDate = $results->sortByDesc('date');

        $resultNumbers->each(function (string $number) use (&$numbers) {
            $numbers[$number]++;
        });

        return collect($numbers)->map(fn(int $occurrences, string $number) => DetailedNumberData::from([
            'number' => $number,
            'occurrences' => $occurrences,
            'weight' => $weight = $this->getWeight($numbers, $occurrences),
            'lightness' => $this->getLightnessPercent($weight),
            'last_occurrence_in_contests' => $this->getLastOccurrenceInContests($number, $resultsSortedByDate),
            'is_even' => intval($number) % 2 === 0
        ]))->sortBy('number')->values();
    }

    /**
     * Summary of getUnluckyNumbers
     * @param Collection<int, \App\Data\DetailedNumberData> $numbers
     * @return Collection<int, \App\Data\DetailedNumberData>
     */
    public function getUnluckyNumbers(Collection $numbers)
    {
        return $numbers->where('last_occurrence_in_contests', '>', 20)->values();
    }


    /**
     * @param array<string, int> $numbersWithOccurrences
     * @param int $occurrences
     * @return float
     */
    private function getWeight(array $numbersWithOccurrences, int $occurrences): float
    {
        assert(!empty($numbersWithOccurrences));

        $min = min($numbersWithOccurrences);
        $max = max($numbersWithOccurrences);

        if ($max === 0 && $min === 0) {
            return 0;
        }

        $baseWeight = ($occurrences - $min) / ($max - $min);

        return round($baseWeight * 100, 4);
    }

    private function getLightnessPercent(float $weight): float
    {
        $MAX_THRESHOLD = 90;
        $MIN_THRESHOLD = 10;

        $darkness = $weight;

        if ($weight < $MIN_THRESHOLD) {
            $darkness = $MIN_THRESHOLD;
        }

        if ($weight > $MAX_THRESHOLD) {
            $darkness = $MAX_THRESHOLD;
        }

        return 100 - $darkness;
    }

    /**
     * @param string $number
     * @param Collection<int, \App\Models\LotteryResult> $resultsSortedByDate
     * @return int|null
     */
    private function getLastOccurrenceInContests(string $number, Collection $resultsSortedByDate): int|null
    {
        $lastContest = $resultsSortedByDate->first();
        $lastContestWithNumber = $resultsSortedByDate->filter(
            fn(LotteryResult $result) => in_array($number, $result->numbers)
        )->first();

        if (!$lastContest || !$lastContestWithNumber) {
            return null;
        }

        return intval($lastContest->contest) - intval($lastContestWithNumber->contest);
    }
}
