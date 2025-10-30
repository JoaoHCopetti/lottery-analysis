<?php

namespace App\Actions\MegaSena;

use Illuminate\Support\Facades\Storage;

class MegaSenaStoreXlsxContentAction
{
    public static string $FILE_NAME = 'mega-sena.xlsx';

    public function execute(string $content): string
    {
        Storage::put(static::$FILE_NAME, $content);

        return Storage::path('mega-sena.xlsx');
    }
}
