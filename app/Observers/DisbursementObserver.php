<?php

namespace App\Observers;

use App\Models\Disbursement;

class DisbursementObserver
{
    /**
     * Handle the Disbursement "created" event.
     */
    public function creating(Disbursement $disbursement): void
    {
        do {
            $numericPart = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $uniqueId = 'DMT' . $numericPart;
        } while (Disbursement::where('unique_id', $uniqueId)->exists());

        $disbursement->unique_id = $uniqueId;
    }

    /**
     * Handle the Disbursement "updated" event.
     */
    public function updated(Disbursement $disbursement): void
    {
        //
    }

    /**
     * Handle the Disbursement "deleted" event.
     */
    public function deleted(Disbursement $disbursement): void
    {
        //
    }

    /**
     * Handle the Disbursement "restored" event.
     */
    public function restored(Disbursement $disbursement): void
    {
        //
    }

    /**
     * Handle the Disbursement "force deleted" event.
     */
    public function forceDeleted(Disbursement $disbursement): void
    {
        //
    }
}
