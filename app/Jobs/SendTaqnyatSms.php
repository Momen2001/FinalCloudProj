<?php

namespace App\Jobs;

use App\Services\TaqnyatSms;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class SendTaqnyatSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public $msg;
    public $fullPhone;

    public $timeout = 900;

    /**
     * Create a new job instance.
     * @return void
     */
    public function __construct($msg, $fullPhone)
    {
        $this->msg = $msg;
        $this->fullPhone = $fullPhone;
    }

    /**
     * Execute the job.
     *
     * @return void
     *
     */
    public function handle()
    {
        TaqnyatSms::sendMessage($this->msg, $this->fullPhone);
    }
}



