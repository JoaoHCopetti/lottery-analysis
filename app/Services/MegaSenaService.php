<?php

namespace App\Services;

use App\Data\LotteryResultData;
use App\Interfaces\LotteryResultsInterface;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client as HttpClient;
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
        $xlsxData = collect(SpreadsheetFactory::load($xlsxPath)->getActiveSheet()->toArray());

        $this->clearNonResults($xlsxData);

        return $xlsxData->map(fn ($result) => new LotteryResultData(
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

    private function clearNonResults(Collection $xlsxData)
    {
        $xlsxData->splice(0, 7);
    }

    private function getResultId(array $result): string
    {
        return $result[0];
    }

    private function getResultNumbers(array $result): array
    {
        return array_slice($result, -6);
    }

    private function getResultDate(array $result): string
    {
        return Carbon::createFromFormat('d/m/Y', $result[1])->toDateString();
    }
}
