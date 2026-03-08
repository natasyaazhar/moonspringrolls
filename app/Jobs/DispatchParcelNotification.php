<?php

namespace App\Jobs;

use App\Models\ParcelUpdate;
use App\Mail\Outbound;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class DispatchParcelNotification //++ implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $parcel;

    public function __construct(ParcelUpdate $parcel)
    {
        $this->parcel = $parcel;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {

        Log::info("DispatchParcelNotification: Sending email to {$this->parcel->email}");
        Mail::to($this->parcel->email)
                ->bcc('qasyaaa@gmail.com')
                ->send(new Outbound($this->parcel));

        Log::info("DispatchParcelNotification: Email sent to {$this->parcel->email}");
        
        $this->parcel->update([
            'updated_at' => now()
        ]);

        } catch (\Exception $e) {
            Log::error("DispatchParcelNotification failed: " . $e->getMessage());
            throw $e;
        }
    }
}
