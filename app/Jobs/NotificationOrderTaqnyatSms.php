<?php

namespace App\Jobs;

use App\Services\TaqnyatSms;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class NotificationOrderTaqnyatSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public $msg;
    public $order;

    public $timeout = 900;

    /**
     * Create a new job instance.
     * @return void
     */
    public function __construct($order, $msg)
    {
        $this->order = $order;
        $this->msg = $msg;
    }

    /**
     * Execute the job.
     *
     * @return void
     *
     */
    public function handle()
    {
        TaqnyatSms::NotificationOrder($this->order, $this->msg);
    }
}



