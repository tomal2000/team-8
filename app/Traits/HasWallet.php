<?php

namespace App\Traits;

use App\Exceptions\InvalidAmountException;
use App\Exceptions\InsufficientFundException;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasWallet
{
    public function deposit(int|float $amount, array $transaction, bool $confirmed = true): mixed
    {
        $this->throwExceptionIfAmountIsInvalid($amount);

        if($confirmed == true){
            $this->increment('balance', $amount);
        }
        $fee = $transaction['fee'] ?? 0;
        $transaction = $this->transactions()->create([
            'reference_id' => $transaction['reference_id'] ?? null,
            'gateway_id' => $transaction['gateway_id'] ?? null,
            'initiator' => $transaction['initiator'] ?? 0,
            'approver' => $transaction['approver'] ?? 0,
            'type' => 'credit',
            'module' => $transaction['module'],
            'narration' => $transaction['narration'],
            'description' => $transaction['description'],
            'principal_amount' => $transaction['principal_amount'],
            'fee' => $fee,
            'amount' => $amount - $fee,
            'remain_balance' => $this->balance,
            //'meta' => $transaction['meta'],
            'status' => $confirmed == true ? 'completed' : 'initiated',
        ]);

        return $transaction;
    }

    public function withdraw(int|float $amount,array $transaction): float|int
    {
        $this->throwExceptionIfAmountIsInvalid($amount);

        $this->throwExceptionIfFundIsInsufficient($amount);

        $this->decrement('balance', $amount);
        return $this->balance;
    }

    public function canWithdraw(int|float $amount): bool
    {
        $this->throwExceptionIfAmountIsInvalid($amount);

        $balance = $this->balance ?? 0;

        return $balance >= $amount;
    }

    public function wallet_balance(): Attribute
    {
        return Attribute::get(fn () => $this->balance ?? 0);
    }

    public function throwExceptionIfAmountIsInvalid(int|float $amount): void
    {
        if ($amount <= 0) {
            throw new InvalidAmountException();
        }
    }

    public function throwExceptionIfFundIsInsufficient(int|float $amount): void
    {
        if (! $this->canWithdraw($amount)) {
            throw new InsufficientFundException();
        }
    }

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
}
