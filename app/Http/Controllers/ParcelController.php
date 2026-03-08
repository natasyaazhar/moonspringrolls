<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ParcelUpdate;
use App\Services\GoogleSheetService;
use App\Services\ParcelAutomationService;
use App\Jobs\DispatchParcelNotification;
use Carbon\Carbon;


class ParcelController extends Controller
{
    public function index()
    {
        $parcels = [];

        $rawList = ParcelUpdate::latest()->get();
        foreach($rawList as $parcel){
            $parcels[] = [
                'id'            => $parcel->id,
                'name'          => $parcel->name,
                'email'         => $parcel->email,
                'parcel_status' => $parcel->parcel_status,
                'created_at'    => $parcel->created_at,
                'updated_at'    => $parcel->updated_at ? Carbon::parse($parcel->updated_at)->diffForHumans() : 'Not sent yet',
            ];
        }

        return view('dashboard', compact('parcels'));

    }


    public function sync(
        GoogleSheetService $sheet,
        ParcelAutomationService $automation
    ){

        $rows = $sheet->fetchRows();

        $automation->processSheetRows($rows);

        return redirect('/')->with('success','Spreadsheet synced successfully');

    }

    public function sendEmails()
    {

        $parcels = ParcelUpdate::where('parcel_status', 'Out For Delivery')
                    ->whereNull('updated_at')
                    ->get();

        if ($parcels->count() === 0){
            return redirect('/')->with('error', 'Please sync spreadsheet first.');
        } else {
            foreach ($parcels as $parcel) {
                $job = new DispatchParcelNotification($parcel);
                $job->handle();
            }
            return redirect('/')->with('success','Out For Delivery emails sent');
        }
    }
}
