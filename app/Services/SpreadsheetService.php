<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\IOFactory as SpreadsheetFactory;

class SpreadsheetService
{
    /**
     * @return array<mixed[]>
     */
    public function spreadsheetToArray(string $filepath): array
    {
        return SpreadsheetFactory::load($filepath)->getActiveSheet()->toArray();
    }
}
