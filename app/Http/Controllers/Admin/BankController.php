<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Bank;

class BankController extends Controller
{
    public function index(): View
    {
        $banks = Bank::paginate(15);
        return view('admin.bank.index',compact('banks'));
    }
}
