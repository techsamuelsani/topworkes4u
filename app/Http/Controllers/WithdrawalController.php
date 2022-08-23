<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App;

class WithdrawalController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('redirectIfAdmin');
    }
    public function index($username)
    {
        $user=Auth::User();
        if($username==$user->username) {
            $withdrawals=$user->withdrawals->take(10);
            return view('dashboard.withdrawals')->with('withdrawals',$withdrawals);
        }

        return abort(404);
    }

    public function saveRequest($username)
    {
        request()->validate([
            'email' => 'required|email',
        ]);
        $user=Auth::User();
        if($username==$user->username && !$user->ifHasPandingWithdrawal()) {
           if($user->balance>=50){
               $balance=$user->balance;
               $email=request()->email;
               $withdrawal=new App\Withdrawal;
               $withdrawal->user_id=$user->id;
               $withdrawal->amount=$balance;
               $withdrawal->email=$email;
               $withdrawal->save();
               return redirect()->back();

           }


        }

        return abort(404);
    }
}
