<?php

namespace App\Interfaces;

interface Wallet
{
    public function deposit(int|float $amount, array $transaction, bool $confirmed): mixed;

    public function withdraw(int|float $amount, array $transaction): int|float;

    public function canWithdraw(int|float $amount): bool;

    public function throwExceptionIfAmountIsInvalid(int|float $amount): void;

    public function throwExceptionIfFundIsInsufficient(int|float $amount): void;
}
