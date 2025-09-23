<?php

namespace App\Services;

use App\Data\LotteryResultData;
use App\Interfaces\LotteryResultsInterface;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory as SpreadsheetFactory;

class MegaSenaService implements LotteryResultsInterface
{
    /**
     * @return Collection<int, LotteryResultData>
     */
    public function getResults(): Collection
    {
        $xlsx =  $this->fetchXlsx();
        $xlsxPath = $this->storeXlsx($xlsx);

        /**
         * @var Collection<int, array<string|null>>
         */
        $xlsxData = collect(SpreadsheetFactory::load($xlsxPath)->getActiveSheet()->toArray());

        $this->formatXlsx($xlsxData);

        return $xlsxData->map(fn (array $result) => new LotteryResultData(
            $this->getResultId($result),
            $this->getResultNumbers($result),
            $this->getResultDate($result)
        ));
    }

    private function fetchXlsx(): string
    {
        $response = app(HttpClient::class)->post('https://asloterias.com.br/download_excel.php', [
            'form_params' => [
                'l' => 'ms',
                't' => 't',
                'o' => 'c',
                'f1' => '',
                'f2' => ''
            ]
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new Exception('Error while retrieving data');
        }

        return $response->getBody()->getContents();
    }

    private function storeXlsx(string $xlsx): string
    {
        $fileName = 'mega-sena-results.xlsx';

        Storage::put($fileName, $xlsx);

        return Storage::path('mega-sena-results.xlsx');
    }

    /**
     * @param Collection<int, array<string|null>>  $xlsxData
     * @return Collection<int, array<string|null>>
     */
    private function formatXlsx(Collection $xlsxData): Collection
    {
        return $xlsxData->splice(0, 7);
    }

    /**
     * @param array<string|null> $result
     * @return string
     */
    private function getResultId(array $result): string
    {
        return $result[0] ?? '';
    }

    /**
     * @param array<string|null> $result
     * @return array<string>
     */
    private function getResultNumbers(array $result): array
    {
        $numbers = array_slice($result, -6);

        if (in_array(null, $numbers)) {
            throw new Exception("Numbers array can't contain null values");
        }

        /**
         * @var array<string>
         */
        return $numbers;
    }

    /**
     * @param array<string|null> $result
     * @throws \Exception
     * @return string
     */
    private function getResultDate(array $result): string
    {
        if ($result[1] === null) {
            throw new Exception("XLSX cell can't be null");
        }

        $date = Carbon::createFromFormat('d/m/Y', $result[1]);

        if ($date === null) {
            throw new Exception("Couldn't parse cell date");
        }

        return $date->toDateString();
    }
}
