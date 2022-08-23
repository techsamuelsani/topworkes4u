<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App;
use App\File;
use Storage;

class FileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getFile($id){
        $user=Auth::User();
        $delivery=App\Delivery::find($id);
        if($delivery->order->buyer==$user ||$delivery->order->seller()==$user) {
           if($delivery->fileLink) {
               $file = $delivery->fileLink;
               return Storage::download($file);
           }
        }
        return abort(404);
    }

    public function getTicketFile($id,$name){
        $ticket=App\Ticket::find($id);
        if($ticket) {
            $user = Auth::User();
            if ($ticket->user->id == $user->id || $user->type == 'admin') {
                    $file = $name;
                    return Storage::download($file);
            }
        }
        return abort(404);
    }



}
