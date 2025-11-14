<?php

use App\Http\Controllers\PaymentController;
use App\Models\Designation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Jobs\ProfitShareDistribute;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserCreateNotification;

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

Route::get('/', function () {
   return redirect()->route('payment.user_find');
});

Route::get('/user/find', [PaymentController::class, 'user_find'])->name('payment.user_find');
Route::post('/user/find', [PaymentController::class, 'user_find_get']);
Route::get('/payment/{id}', [PaymentController::class, 'payment_user'])->name('payment.user');

Route::get('/test', [TestController::class, 'test']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
