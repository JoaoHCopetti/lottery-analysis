<?php

namespace App\Services;

use App\Data\LotteryResultData;
use Illuminate\Support\Collection;

class HeatmapService
{
    /**
     * @param \Illuminate\Support\Collection<int, LotteryResultData> $results
     * @return Collection<int, array{number: int, occurrences: int, weight: float>}
     */
    public function getResultsHeatmap(Collection $results)
    {
        $allNumbers = $results->pluck('numbers')->collapse()->values();
        $numbersWithOccurrences = $allNumbers->unique()->sort()->values()->mapWithKeys(fn ($value) => [$value => 0])->toArray();

        $allNumbers->each(function ($number) use (&$numbersWithOccurrences) {
            $numbersWithOccurrences[$number]++;
        });

        return collect($numbersWithOccurrences)->map(fn ($occurrences, $number) => [
            'number' => $number,
            'occurrences' => $occurrences,
            'weight' => $weight = $this->getWeight($numbersWithOccurrences, $occurrences),
            'lightness' => $this->getLightness($weight)
        ])->sortBy('number')->values();
    }

    private function getWeight($numbersWithOccurrences, $occurrences)
    {
        $min = min($numbersWithOccurrences);
        $max = max($numbersWithOccurrences);
        $baseWeight = bcdiv(bcsub($occurrences, $min, 4), bcsub($max, $min, 4), 4);

        return round($baseWeight * 100, 4);
    }

    private function getLightness(float $weight)
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
