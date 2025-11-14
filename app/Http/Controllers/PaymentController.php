<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function user_find(){
        return view('welcome');
    }

    public function user_find_get(Request $request){
        $user = User::where('unique_id',$request->value)->orWhere('mobile',$request->value)->first();
        return redirect()->route('payment.user',$user->id);
    }

    public function payment_user($id){
        $user = User::findOrFail($id);
        return view('payment',compact('user'));
    }
}
