<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;

class MegaSenaStoreXlsxContentAction
{
    public static string $FILE_NAME = 'mega-sena-results.xlsx';

    public function execute(string $content): string
    {
        Storage::put(static::$FILE_NAME, $content);

        return Storage::path('mega-sena-results.xlsx');
    }
}
