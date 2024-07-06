<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $appends = ['transaction_at'];

    protected $fillable = [
        'transactionable_id',
        'transactionable_type',
        'transaction_id',
        'reference_id',
        'gateway_id',
        'initiator',
        'approver',
        'type',
        'module',
        'narration',
        'description',
        'principal_amount',
        'fee',
        'amount',
        'remain_balance',
        'meta',
        'status',
    ];

    public function getTransactionAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('m-d-Y h:i A');
    }

    public function transactionable(): MorphTo
    {
        return $this->morphTo();
    }
}
