<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App;
use Storage;
class TicketController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function open(){

        $user=Auth::user();
        request()->validate([
            'title' => 'required|string',
            'details' => 'required|string',
        ]);

        $ticket=new App\Ticket;
        $ticket->title=request()->title;
        $ticket->details=request()->details;
        $ticket->user_id=$user->id;

        if(request()->file){
            request()->validate([
                'file' => 'required|mimes:zip',
            ]);
            $fileName = $user->id."_".time().'.'.request()->file->getClientOriginalExtension();
            Storage::put($fileName, file_get_contents(request()->file));
            $ticket->fileLink=$fileName;
        }
        $ticket->save();
        return redirect()->back();

    }

    public  function tickets(){

        $user=Auth::user();
        $tickets=$user->tickets;
        return view('dashboard.tickets')->with('tickets',$tickets);

    }
    public  function ticket($id){
        $user=Auth::user();

        $ticket=App\Ticket::find($id);

        if($ticket){
            if($ticket->user->id==$user->id || $user->type=='admin') {
                return view('ticket')->with('ticket', $ticket);
            }
        }
        return abort(404);
    }

    public  function reply($id){
        $user=Auth::user();

        $ticket=App\Ticket::find($id);

        if($ticket){
            if($ticket->user->id==$user->id || $user->type=='admin') {
                request()->validate([
                    'reply' => 'required|string',
                ]);
                $reply=new App\Reply;
                $reply->reply=request()->reply;
                $reply->user_id=$user->id;
                $reply->ticket_id=$ticket->id;
                if(request()->file){
                    request()->validate([
                        'file' => 'required|mimes:zip',
                    ]);
                    $fileName = $user->id."_".time().'.'.request()->file->getClientOriginalExtension();
                    Storage::put($fileName, file_get_contents(request()->file));
                    $reply->fileLink=$fileName;
                }
                if($user->type=='admin'){
                    $ticket->status=1;
                }
                $reply->save();
                $ticket->save();
                return redirect()->back();
            }
        }
        return abort(404);
    }
}
