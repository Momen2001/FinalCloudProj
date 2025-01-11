<?php

namespace App\Observers;
use App\Models\Offer;

class OfferObserver
{
    /**
     * Handle the User "creating" event.
     *
     * @param \App\Models\User $offer
     * @return void
     */
    public function creating(Offer $offer)
    {
         $offer->uuid = 'H' . rand(1111, 9999);
    }

    /**
     * Handle the User "created" event.
     *
     * @param \App\Models\User $offer
     * @return void
     */
    public function created(Offer $offer)
    {

    }

    /**
     * Handle the User "updated" event.
     *
     * @param \App\Models\User $offer
     * @return void
     */
    public function updated(Offer $offer)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param \App\Models\User $offer
     * @return void
     */
    public function deleted(Offer $offer)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param \App\Models\User $offer
     * @return void
     */
    public function restored(Offer $offer)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param \App\Models\User $offer
     * @return void
     */
    public function forceDeleted(Offer $offer)
    {
        //
    }
}
