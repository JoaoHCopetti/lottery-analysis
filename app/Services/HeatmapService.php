<?php

namespace App\Services;

use App\Data\LotteryResultData;
use Exception;
use Illuminate\Support\Collection;

class HeatmapService
{
    /**
     * Summary of getResultsHeatmap
     * @param Collection<int, LotteryResultData> $results
     * @return Collection<int, array{number: string, occurrences: int, weight: float, lightness: float}>
     */
    public function getResultsHeatmap(Collection $results)
    {
        $allNumbers = $results->pluck('numbers')->collapse()->values();

        /**
         * @var array<string, int>
         */
        $numbersWithOccurrences = $allNumbers
            ->unique()
            ->sort()
            ->values()
            ->mapWithKeys(fn (string $value) => [$value => 0])
            ->toArray();

        $allNumbers->each(function (string $number) use (&$numbersWithOccurrences) {
            $numbersWithOccurrences[$number]++;
        });

        return collect($numbersWithOccurrences)->map(fn (int $occurrences, string $number) => [
            'number' => $number,
            'occurrences' => $occurrences,
            'weight' => $weight = $this->getWeight($numbersWithOccurrences, $occurrences),
            'lightness' => $this->getLightness($weight)
        ])->sortBy('number')->values();
    }

    /**
     * Summary of getWeight
     * @param array<string, int> $numbersWithOccurrences
     * @param int $occurrences
     * @return float
     */
    private function getWeight(array $numbersWithOccurrences, int $occurrences): float
    {
        if (empty($numbersWithOccurrences)) {
            throw new Exception("numbers with occurrences can't be empty");
        }

        $min = min($numbersWithOccurrences);
        $max = max($numbersWithOccurrences);

        $baseWeight = ($occurrences - $min) / ($max - $min);

        return round($baseWeight * 100, 4);
    }

    private function getLightness(float $weight): float
    {
        $MAX_THRESHOLD = 80;
        $MIN_THRESHOLD = 20;

        if ($weight < $MIN_THRESHOLD) {
            return $MIN_THRESHOLD;
        }

        if ($weight > $MAX_THRESHOLD) {
            return $MAX_THRESHOLD;
        }

        return $weight;
    }
}
