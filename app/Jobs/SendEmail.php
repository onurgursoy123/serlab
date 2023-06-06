<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

use App\Mail\MailSender;

use App\Models\Pages;
use App\Models\Sales;
use App\Models\DeviceOffer;
use App\Models\ServiceRequest;

use Exception;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data = null)
    {
        //
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sale = Sales::where('is_send', 0)->first();
        if (!empty($sale)) {
            try {
                $page = Pages::where('path', 'admin.sales.mail')->first();
                Mail::to($page->description)->send(new MailSender($sale, 1));
                $sale->is_send = 1;
                $sale->update();

            } catch(Exception $e) {
                
            }
        }

        $serviceRequest = ServiceRequest::where('is_send', 0)->first();
        if (!empty($serviceRequest)) {
            try {
                $page = Pages::where('path', 'admin.form.serviceRequest.mail')->first();
                Mail::to($page->description)->send(new MailSender($serviceRequest, 2));
                $serviceRequest->is_send = 1;
                $serviceRequest->update();

            } catch(Exception $e) {
                
            }
        }

        $deviceOffer = DeviceOffer::where('is_send', 0)->first();
        if (!empty($deviceOffer)) {
            try {
                $page = Pages::where('path', 'admin.form.deviceOffer.mail')->first();
                Mail::to($page->description)->send(new MailSender($deviceOffer, 3));
                $deviceOffer->is_send = 1;
                $deviceOffer->update();

            } catch(Exception $e) {
                
            }
        }
        
    }
}
