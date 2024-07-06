<?php

namespace App\Jobs;

use App\Models\Bank;
use App\Models\User;
use App\Models\Disbursement;
use App\Models\DisbursementQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\UserDepositNotification;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProfitShareDistribute implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pendingDisbursement =  Disbursement::whereIn('status',['in_queued','processed'])->first();
        if($pendingDisbursement){
            $pendingQueues = $pendingDisbursement->disbursementQueues->where('status','initiated');
            if($pendingQueues->count() > 0){
                foreach ($pendingQueues as $key => $pendingQueue) {
                    $userTransaction = $pendingQueue->disbursementable->deposit($pendingQueue->amount,[
                        'module' => 'DMT',
                        'narration' => $pendingDisbursement->name,
                        'description' => $pendingDisbursement->unique_id,
                        'principal_amount' => $pendingQueue->amount,
                        'fee' => 0,
                    ]);
                    Log::debug($pendingQueue);
                    $pendingQueue->update(['status' => 'completed']);
                    $pendingQueue->disbursementable->notify(new UserDepositNotification($userTransaction));

                }
            }
            if($pendingDisbursement->disbursementQueues->where('status','initiated')->count() == 0){
                $pendingDisbursement->update(['status'=>'completed']);
            }
        }

        }
    }
