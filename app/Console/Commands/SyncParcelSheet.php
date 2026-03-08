<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
// use App\Jobs\DispatchParcelNotification;
use App\Services\GoogleSheetService;
use App\Services\ParcelAutomationService;

class SyncParcelSheet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parcel:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Google Sheet and notify recipient';

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
    public function handle(GoogleSheetService $sheet, ParcelAutomationService $automation)
    {
        // return 0;

        $rows = $sheet->fetchRows();

        $automation->processSheetRows($rows);

        $this->info('Parcel notification process completed');

        return Command::SUCCESS;
    }
}
