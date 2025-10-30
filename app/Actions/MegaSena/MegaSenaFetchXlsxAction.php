<?php

namespace App\Actions\MegaSena;

use Exception;
use GuzzleHttp\Client as HttpClient;

class MegaSenaFetchXlsxAction
{
    public function execute(): string
    {
        $response = app(HttpClient::class)->get('https://servicebus2.caixa.gov.br/portaldeloterias/api/resultados/download?modalidade=Mega-Sena');

        if ($response->getStatusCode() !== 200) {
            throw new Exception('Error while retrieving data');
        }

        return $response->getBody()->getContents();
    }
}
