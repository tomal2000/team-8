<?php

namespace App\Models;

use App\Interfaces\Wallet;
use App\Traits\HasWallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model implements Wallet
{
    use HasFactory, HasWallet;

    protected $fillable = [
        'name',
        'branch',
        'routing',
        'account_no',
        'is_active',
        'balance'
    ];
}
