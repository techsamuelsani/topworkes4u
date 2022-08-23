<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkAdmin');


    }

    public function index(){

        return view('admin.index');
    }

    public function pendingServices(){

        $services=App\Service::where('isVerified',null)->orderBy('updated_at','asc')->get();
        return view('admin.pendingServices')->with('services',$services);
    }
    public function service($id){
        $service=App\Service::find($id);
        if($service){
            if(!$service->isVerified){
                return view('admin.service')->with('service',$service);
            }
        }
        return abort(404);

    }
    public function serviceAction($id){
        $service=App\Service::find($id);
        if($service){
            if(!$service->isVerified){
                if(request()->action){
                    if(request()->action=='Approve'){
                        $service->isVerified=1;
                    }
                    if(request()->action=='Reject'){
                        $service->isVerified=0;
                    }
                    $service->save();
                }
            }
        }
        return redirect('\admin\services');

    }

    public function pendingSellers(){

        $users=App\User::where('status',3)->orderBy('updated_at','asc')->get();
        return view('admin.pendingSellers')->with('users',$users);
    }
    public function sellerAction(){
        if(request()->userId && request()->action){
            $userId=request()->userId;
            $action=request()->action;
            $user=App\User::find($userId);
            if($user){
                if($action=="Accept"){
                    $user->type="seller";
                    $user->status=1;
                }
                if($action=="Reject"){
                    $user->status=1;
                }
                $user->save();
            }
        }
        return redirect('\admin\sellers');

    }

    public function pendingJobs(){

        $jobs=App\Job::where('isActive',2)->orderBy('updated_at','asc')->get();
        return view('admin.pendingJobs')->with('jobs',$jobs);
    }
    public function jobAction(){
        if(request()->jobId && request()->action){
            $jobId=request()->jobId;
            $action=request()->action;
            $job=App\Job::find($jobId);
            if($job){
                if($action=="Accept"){
                    $job->isActive=1;
                }
                if($action=="Reject"){
                    $job->isActive=0;
                }
                $job->save();
            }
        }
        return redirect('\admin\jobs');

    }

    public function pendingRecharges(){

        $recharges=App\Recharge::where('status',0)->orderBy('updated_at','asc')->get();
        return view('admin.pendingRecharges')->with('recharges',$recharges);
    }
    public function actionRecharge(){
        if(request()->rechargeId && request()->action){
            $rechargeId=request()->rechargeId;
            $action=request()->action;
            $recharge=App\Recharge::find($rechargeId);
            if($recharge){
                if($action=="Accept"){
                    $dollerRate=120;
                    $recharge->status=1;
                    $recharge->user->balance+=
                    $recharge->amountDollers=(($recharge->amount)/$dollerRate);
                    $recharge->user->save();
                }
                if($action=="Reject"){
                    $recharge->status=2;
                }
                $recharge->save();
            }
        }
        return redirect('\admin\recharges');

    }


    public function pendingWithdrawals(){

        $withdrawals=App\Withdrawal::where('status','Panding')->orderBy('updated_at','asc')->get();
        return view('admin.pendingWithdrawals')->with('withdrawals',$withdrawals);
    }
    public function actionWithdrawals(){
        request()->validate([
            'withdrawal_id' => 'required|integer',
            'action' => 'required|string',
            'comment' => 'required|string']);
        {
            $withdrawalId=request()->withdrawal_id;
            $action=request()->action;
            $comment=request()->comment;
            $transactionNumber=request()->transaction;
            $withdrawal=App\Withdrawal::find($withdrawalId);
            if($withdrawal){
                if($action=="Withdarawal Sent"){
                    $withdrawal->comment=$comment;
                    $withdrawal->status="Withdarawal Sent";
                    $withdrawal->user->balance-=$withdrawal->amount;
                    $withdrawal->user->save();
                    $withdrawal->transactionNumber=$transactionNumber;
                }
                if($action=="Withdrawal not sent"){
                    $withdrawal->comment=$comment;
                    $withdrawal->status="Withdarawal not Sent";
                }
                $withdrawal->save();
            }
        }
        return redirect('\admin\withdrawals');

    }
}
