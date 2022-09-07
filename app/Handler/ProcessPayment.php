<?php

namespace App\Handler;

use Illuminate\Support\Facades\Log;
use \Spatie\WebhookClient\ProcessWebhookJob;
use stdClass;

//The class extends "ProcessWebhookJob" class as that is the class //that will handle the job of processing our webhook before we have //access to it.
class ProcessPayment extends ProcessWebhookJob
{

    public function handle()
    {
        $data = json_decode($this->webhookCall, true);
        Log::info($data);
        http_response_code(200); //Acknowledge you received the response
    }
}
