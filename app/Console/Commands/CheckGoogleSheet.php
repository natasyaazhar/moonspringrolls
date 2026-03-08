<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google\Client;
use Google\Service\Sheets;

class CheckGoogleSheet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sheet:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Google Sheet connection and env variable';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sheetId = env('GOOGLE_SHEET_ID');

        if (!$sheetId) {
            $this->error('GOOGLE_SHEET_ID is null! Check your .env and config cache.');
            return 1;
        }

        $this->info("GOOGLE_SHEET_ID loaded: $sheetId");

        try {
            $client = new Client();
            $client->setApplicationName('Popia Delivery Automation');
            $client->setScopes([Sheets::SPREADSHEETS_READONLY]);
            $client->setAuthConfig(storage_path('app/google/natasyaazharportfolio-89ef55bb4d4b4.json'));

            $service = new Sheets($client);
            $range = 'Data!A2:C';

            $response = $service->spreadsheets_values->get($sheetId, $range);

            $values = $response->getValues();

            $this->info("Successfully fetched " . count($values) . " rows from the sheet.");
            $this->line(print_r($values, true));

        } catch (\Exception $e) {
            $this->error("Error connecting to Google Sheets: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
