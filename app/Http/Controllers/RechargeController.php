<?php

namespace App\Http\Controllers;

use App;
use Auth;
use Illuminate\Http\Request;

class RechargeController extends Controller
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
            $recharges=$user->recharges->take(10);
            return view('dashboard.recharge')->with('recharges',$recharges);
        }

        return abort(404);
    }

    public function saveRequest($username)
    {
        $user=Auth::User();
        if($username==$user->username) {
            request()->validate([
                'amount' => 'required|integer|min:500',
                'date'=> 'required|date',
                'senderNumber'=> 'required|string',
                'transactionNo'=> 'required|string',
                'cellular'=> 'required|string',
            ]);
            $request=new App\Recharge;
            $request->user_id=$user->id;
            $request->cellular=request()->cellular;
            $request->senderNumber=request()->senderNumber;
            $request->transactionId=request()->transactionNo;
            $request->date=request()->date;
            $request->amount=request()->amount;
            $request->save();
            return redirect()->back();

        }

        return abort(404);
    }

}
