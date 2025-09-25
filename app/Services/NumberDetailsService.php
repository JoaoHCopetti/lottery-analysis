<?php

namespace App\Services;

use Exception;

class NumberDetailsService
{
    /**
     * @param \Illuminate\Database\Eloquent\Collection<int, \App\Models\LotteryResult> $results
     * @return \Illuminate\Support\Collection<int, array{number: string, occurrences: int, weight: float, lightness: float}>
     */
    public function getDetailedNumbers($results)
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
            'lightness' => (100 - $this->getDarkness($weight))
        ])->sortBy('number')->values();
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

        $baseWeight = ($occurrences - $min) / ($max - $min);

        return round($baseWeight * 100, 4);
    }

    private function getDarkness(float $weight): float
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
