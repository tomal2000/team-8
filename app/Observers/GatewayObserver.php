<?php

namespace App\Observers;

use App\Models\Gateway;

class GatewayObserver
{
    /**
     * Handle the Gateway "created" event.
     */
    public function creating(Gateway $gateway): void
    {
        do {
            $numericPart = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $uniqueId = 'GTW' . $numericPart;
        } while (Gateway::where('unique_id', $uniqueId)->exists());

        $gateway->unique_id = $uniqueId;
    }

    /**
     * Handle the Gateway "updated" event.
     */
    public function updated(Gateway $gateway): void
    {
        //
    }

    /**
     * Handle the Gateway "deleted" event.
     */
    public function deleted(Gateway $gateway): void
    {
        //
    }

    /**
     * Handle the Gateway "restored" event.
     */
    public function restored(Gateway $gateway): void
    {
        //
    }

    /**
     * Handle the Gateway "force deleted" event.
     */
    public function forceDeleted(Gateway $gateway): void
    {
        //
    }
}
