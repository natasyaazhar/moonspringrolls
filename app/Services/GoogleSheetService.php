<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;

class GoogleSheetService
{

    public function fetchRows()
    {

        $client = new Client();

        $client->setApplicationName('Popia Delivery Automation');

        $client->setScopes([Sheets::SPREADSHEETS_READONLY]);

        $client->setAuthConfig(storage_path('app/google/natasyaazharportfolio-981dc9ef4c24.json'));

        $service = new Sheets($client);

        $spreadsheetId = env('GOOGLE_SHEET_ID');

        $range = 'Data!A2:D';

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);

        return $response->getValues();

    }

}