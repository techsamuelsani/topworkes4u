<?php

namespace App\Http\Controllers;
use App;
use Auth;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('redirectIfAdmin');
    }

    public function index(){
        $me=Auth::User(); $infor=new Collection();
        $inform=DB::table('messages')->select('sender_id','receiver_id')->distinct()->where([
            ['sender_id',$me->id],
            ['reference',null],
        ])->orWhere([
            ['receiver_id',$me->id],
            ['reference',null],
        ])->get();
       $ids=[];
        foreach ($inform as $in){
            array_push($ids,$in->sender_id);
            array_push($ids,$in->receiver_id);
        }
        $ids=array_unique($ids);

        return view('inbox')->with('ids',$ids);
    }

    public function  conversation($username){
        $me=Auth::User();
        if($me->username!=$username){
           $user=App\User::where('username',$username)->first();
           if($user){
               $conversation=App\Message::where([
                   ['sender_id',$me->id],
                   ['receiver_id',$user->id],
                   ['reference',null],
               ])->orWhere([
                   ['sender_id',$user->id],
                   ['receiver_id',$me->id],
                   ['reference',null],
               ])->orderBy('created_at', 'asc')->get();
               return view('conversation')->with('user',$user)->with('conversation',$conversation);
           }
        }
        return abort(404);
    }
    public function  saveMessage($username){
        $me=Auth::User();
        if($me->username!=$username){

            $user=App\User::where('username',$username)->first();
            if($user){
                request()->validate([
                    'message' => 'required|string',
                 ]);
                $message=new App\Message();
                $message->sender_id=$me->id;
                $message->receiver_id=$user->id;
                $message->body=request()->message;
                $message->save();
                return redirect()->back();
            }
        }
        return abort(404);
    }

    public function  ajaxNew($username){
        $me=Auth::User();
        if($me->username!=$username){
            $user=App\User::where('username',$username)->first();
            if($user){
                $conversation=App\Message::where([
                    ['sender_id',$user->id],
                    ['receiver_id',$me->id],
                    ['isSeen',0],
                    ['reference',null],
                ])->orderBy('created_at', 'asc')->get();
                return view('messageAjax')->with('user',$user)->with('conversation',$conversation);
            }
        }
        return abort(404);
    }
}
