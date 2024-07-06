<?php

use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\Setup\DesignationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Models\Bank;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        $userBalance = User::all()->sum('balance');
        $handCash = Bank::where('account_no','9999')->first();
        return view('dashboard',compact('userBalance','handCash'));
    })->name('dashboard');

    Route::prefix('setup')->name('setup.')->group(function () {
        Route::prefix('designation')->name('designation.')->controller(DesignationController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });
    Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store');
        Route::post('/deposit', 'deposit')->name('deposit');
        Route::get('/transactions', 'transactions')->name('transactions');
        Route::post('/profit/calculate', 'calculateProfit')->name('calculateProfit');
        Route::post('/profit/distribute', 'distributeProfit')->name('distributeProfit');
    });

    Route::prefix('bank')->name('bank.')->controller(BankController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
