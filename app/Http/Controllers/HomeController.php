<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use App;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('redirectIfAdmin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services=App\Service::where('isVerified',1)->orderBy('created_at', 'asc')->take(20)->get();
        $services=$services->shuffle();
        $services=$services->take(8);

        $tending =App\Service::where('isVerified',1)->orderBy('views','asc')->take(50)->get();
        $tending=$tending->shuffle();
        $tending=$tending->take(8);
        $topp=collect([]); 

        $top=App\Service::where('isVerified',1)->get();
        foreach ($top as $t){
            if($t->averageRating()>4.6){
                $topp->push($t);
            }
        }
        $top=$topp->shuffle();
        $top->take(8);

        return view('home')->with('trending',$tending)->with('top',$top)->with('services',$services);
    }
    
    public function ajaxNote($id)
    {
    if(Auth::check()){
        $idd=Auth::id();
        $notes=App\Notification::Where([['user_id',$idd],['id','>',$id]])->get();
        return $notes->toJson();

        }
    }




}
