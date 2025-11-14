<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(){
    //     $user = User::find(2);
    //    return $user->deposit(500,[
    //         'initiator' => 0,
    //         'approver' => 0,
    //         'module' => 'CHK',
    //         'narration' => 'Test Checkout',
    //         'description' => 'General Deposit',
    //         'principal_amount' => 500,
    //         'fee' => 0 ?? 0,
    //     ],false);
    $user = User::find(2);
    $transaction = Transaction::find(51);
    return $user->confirm($transaction);
    }
}
