<?php

namespace App\Jobs;

use App\Services\FirebaseService;
use App\Services\OrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;

class SendFcmNotificationOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public $order;
    public $title;
    public $msg;

    public $timeout = 900;

    /**
     * Create a new job instance.
     * @return void
     */
    public function __construct($user, $title, $msg, $order)
    {
        $this->user = $user;
        $this->title = $title;
        $this->msg = $msg;
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     *
     */
    public function handle()
    {
        OrderStatus::NotificationOrder($this->user, $this->title, $this->msg, $this->order);

    }
}



