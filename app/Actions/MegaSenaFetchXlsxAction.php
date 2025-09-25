<?php

namespace App\Actions;

use GuzzleHttp\Client as HttpClient;

class MegaSenaFetchXlsxAction
{
    public function execute(): string
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
            throw new \Exception('Error while retrieving data');
        }

        return $response->getBody()->getContents();
    }
}
