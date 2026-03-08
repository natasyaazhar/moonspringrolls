<?php

namespace App\Services;

use App\Models\ParcelUpdate;
use App\Jobs\DispatchParcelNotification;

class ParcelAutomationService
{

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


        }

    }

}