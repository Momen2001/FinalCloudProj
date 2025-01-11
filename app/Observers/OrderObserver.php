<?php

namespace App\Observers;
use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the User "creating" event.
     *
     * @param \App\Models\User $order
     * @return void
     */
    public function creating(Order $order)
    {
        //
        // hash password befor adding in DB
        $order->owner_patient_id = auth()->user()->id;
        $order->order_id = 'H' . rand(111111111, 999999999);

    }

    /**
     * Handle the User "created" event.
     *
     * @param \App\Models\User $order
     * @return void
     */
    public function created(Order $order)
    {

    }

    /**
     * Handle the User "updated" event.
     *
     * @param \App\Models\User $order
     * @return void
     */
    public function updated(Order $order)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param \App\Models\User $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param \App\Models\User $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param \App\Models\User $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
