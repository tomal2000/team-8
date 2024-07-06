<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Jobs\ProfitShareDistribute;
use App\Models\Disbursement;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\UserCreateNotification;
use App\Notifications\UserDepositNotification;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::paginate(15);
        return view('admin.user.index',compact('users'));
    }

    public function create(): View
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'mobile' => ['required', 'numeric', 'digits:11','unique:'.User::class],
            'role' => ['required'],
            'is_payment_collector' => ['nullable','boolean'],
        ]);
        $password = Str::upper(Str::random(6));
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'password' => Hash::make($password),
            'is_payment_collector' => $request->is_payment_collector ?? false,
        ]);
        $user->addRole($request->role);
        $user->notify(new UserCreateNotification($password));
        Alert::success('User Create Successfully', 'User Id:'. $user->unique_id);
        return redirect()->route('admin.user.index');
    }

    public function deposit(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer'],
            'amount' => ['required', 'numeric'],
            'fee' => ['required', 'numeric'],
            'narration' => ['required','string', 'max:255'],
        ]);

        $user = User::findOrFail($request->id);
        $handCash = Bank::where('account_no','9999')->firstOrFail();
        try {
            DB::beginTransaction();
            $userTransaction = $user->deposit($request->amount - $request->fee,[
                'initiator' => Auth::id(),
                'approver' => Auth::id(),
                'module' => 'GDP',
                'narration' => $request->narration,
                'description' => 'General Deposit',
                'principal_amount' => $request->amount,
                'fee' => $request->fee ?? 0,
                //'amount' => $transaction['fee'] ?? 0 + $request->amount,
                //'meta' => [],
            ]);
            $cashTransaction = $handCash->deposit($request->amount,[
                'initiator' => Auth::id(),
                'approver' => Auth::id(),
                'module' => 'GDP',
                'narration' => $request->narration,
                'description' => 'General Deposit',
                'principal_amount' => $request->amount,
                'fee' => 0,
                //'amount' => $transaction['fee'] ?? 0 + $request->amount,
                //'meta' => [],
            ]);
            DB::commit();


        $user->notify(new UserDepositNotification($userTransaction));
        Alert::success('Deposit Successful', 'User Id:'. $user->unique_id.' Amount:'. $userTransaction->principal_amount.' Fee:'. $userTransaction->fee);
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Deposit Failed', 'Try Again Later');
        }
        return redirect()->route('admin.user.index');
    }

    public function transactions(){
        $transactions = Transaction::where('transactionable_type',User::class)->latest()->paginate(10);
        return view('admin.user.transactions',compact('transactions'));
    }

    public function calculateProfit(Request $request){
        // Fetch all users with their account balances
        $users = User::all(['id','unique_id', 'first_name','last_name','balance']);

        // Calculate total profit
        $totalProfit = $request->amount;

        // Calculate total balance
        $totalBalance = $users->sum('balance');

        // Calculate profit share for each user
        $profitShares = $users->map(function ($user) use ($totalBalance, $totalProfit) {
            $proportion = $user->balance / $totalBalance;
            $profitShare = round($proportion * $totalProfit, 2);
            return [
                'user_id' => $user->id,
                'unique_id' => $user->unique_id,
                'name' => $user->first_name.' '.$user->last_name,
                'balance' => $user->balance,
                'profit_share' => $profitShare,
            ];
        });
        return response()->json($profitShares);
    }

    public function distributeProfit(Request $request)
    {
        // Fetch all users with their account balances
        $users = User::all(['id','unique_id', 'first_name','last_name','balance']);

        // Calculate total profit
        $totalProfit = $request->amount;

        // Calculate total balance
        $totalBalance = $users->sum('balance');

        // Calculate profit share for each user
        $profitShares = $users->map(function ($user) use ($totalBalance, $totalProfit) {
            $proportion = $user->balance / $totalBalance;
            $profitShare = round($proportion * $totalProfit, 2);
            return [
                'disbursementable_id' => $user->id,
                'disbursementable_type' => User::class,
                'amount' => $profitShare,
            ];
        });

        try {
            DB::beginTransaction();
            $disbursement = Disbursement::create([
                'name' => $request->narration,
                'amount' => $request->amount,
                'status' => 'in_queued',
            ]);
            $disbursement->disbursementQueues()->createMany($profitShares);
            DB::commit();
            Alert::success('Disbursement Queued', 'Id:'. $disbursement->unique_id);
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
           return $e->getMessage();
            Alert::error('Failed', $e->getMessage());
            return redirect()->back();
        }

    }
}
