<?php

namespace App\Services;

use App\Models\ParcelUpdate;
use App\Jobs\DispatchParcelNotification;
use App\Services\GoogleSheetService;

class ParcelAutomationService
{
    
    protected $sheet;

    public function __construct(GoogleSheetService $sheet)
    {
        $this->sheet = $sheet;
    }

    public function sync()
    {
        $rows = $this->sheet->fetchRows();

        $this->processSheetRows($rows);
    }
    

    public function processSheetRows($rows)
    {

        foreach ($rows as $row) {

            $name               = $row[0] ?? null;
            $email              = $row[1] ?? null;
            $parcel_status      = $row[2] ?? null;
            // $tracking_num       = $row[3] ?? null;
            
            if (!$name || !$email || !$parcel_status) {
                continue;
            }

            $parcel = ParcelUpdate::createParcel($name, $email, $parcel_status);

            /*if (!$parcel->updated_at && $parcel->parcel_status == 'Out For Delivery') {
                DispatchParcelNotification::dispatch($parcel);

                // mark as notified
                $parcel->update(['updated_at' => now()]);
            }*/

            // Update status if changed (but don't touch updated_at yet)
            if ($parcel->parcel_status !== $parcel_status) {
                $parcel->parcel_status = $parcel_status;
                $parcel->saveQuietly(); // avoids changing updated_at manually
            }

            // Only send email if status is 'Out For Delivery' AND updated_at is null
            if($parcel->updated_at == null){

            } else if ($parcel['created_at'] != null && $parcel->parcel_status === 'Out For Delivery' && !$parcel->updated_at) {
                dd('nth updated', $parcel->created_at);
                DispatchParcelNotification::dispatch($parcel);

                // Mark as notified after sending
                $parcel->update(['updated_at' => now()]);
            }

        }

    }

}