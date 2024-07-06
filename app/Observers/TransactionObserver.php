<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function creating(Transaction $transaction): void
    {
        $today = date('Ymd');
        $transactionsNumbers = Transaction::where('transaction_id','like',$today.'%')->pluck('transaction_id');
        do {
            $transactionsNumber = $today.rand(100000,999999);
        } while ($transactionsNumbers->contains($transactionsNumber));

        $transaction->transaction_id = $transactionsNumber;
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
