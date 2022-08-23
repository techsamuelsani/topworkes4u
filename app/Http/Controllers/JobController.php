<?php

namespace App\Http\Controllers;
use App;
use Auth;
use Illuminate\Http\Request;

class JobController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('redirectIfAdmin');
    }

    public function index(){
        $user=Auth::User();
        $jobs=App\Job::where('isActive',1)->where('user_id','!=',$user->id)->get();
        return view('jobs')->with('jobs',$jobs);
    }

    public function saveOffer(){
        request()->validate([
            'service_id' => 'required|exists:services,id',
            'job_id' => 'required|exists:jobs,id',
            'quote'=> 'required|string|max:40|min:10',
            'days'=> 'required|integer|min:1',
            'revisions'=> 'required|integer',
            'price'=> 'required|integer|min:5',
        ]);
        $user=Auth::User();
        $job=App\Job::find(request()->job_id);
        $temp=$job->offers->where('user_id',$user->id)->first();
        if(!$temp){
            $offer=new App\Offer;
            $offer->user_id=$user->id;
            $offer->service_id=request()->service_id;
            $offer->job_id=request()->job_id;
            $offer->price=request()->price;
            $offer->revisions=request()->revisions;
            $offer->quote=request()->quote;
            $offer->days=request()->days;
            $offer->save();
            $link="/job/view/".$job->id;
            $notification=App\Notification::where('link', $link)->delete();
            $notification =new App\Notification;
            $notification->user_id=$job->user->id;
            $notification->title=" You got a new offer";
            $notification->body='There is new offer on "'.$job->title.'"';
            $notification->link=$link;
            $notification->save();
            
        }
       return redirect("/");
    }

    public function showForm(){
        return view('dashboard.postJob');
    }

    public function saveJob(){
        request()->validate([
            'categoryId' => 'required|exists:categories,id',
            'title'=> 'required|string|max:40|min:10',
            'details'=> 'required|string|min:15',
            'requirements'=> 'required|string|min:15',
            'budget'=> 'required|integer|min:5',
            'days'=> 'required|integer|min:1',
        ]);
        $user=Auth::User();
        $job=new App\Job;
        $job->user_id=$user->id;
        $job->category_id=request()->categoryId;
        $job->title=request()->title;
        $job->details=request()->details;
        $job->requirements=request()->requirements;
        $job->budget=request()->budget;
        $job->inDays=request()->days;
        $job->isActive=2;
        $job->save();
        return redirect("/job/view/".$job->id);

    }

    public function manageJobs(){
        $user=Auth::User();
        $jobs=App\Job::where('user_id',$user->id)->get();
        return view('dashboard.manageJobs')->with('jobs',$jobs);
    }
    public function showJob($id){
        $user=Auth::User();
        $job=$user->jobs->find($id);
        if($job){
            return view('dashboard.job')->with('job',$job);
        }
        return abort(404);
    }
    public function removeJob($id){
        $user=Auth::User();
        $job=$user->jobs->find($id);
        if($job){
            $job->delete();
            return redirect('/jobs/manage');
        }
        return abort(404);
    }
    public function deactivateJob($id){
        $user=Auth::User();
        $job=$user->jobs->find($id);
        if($job){
            $job->isActive=2;
            $job->save();
            return redirect()->back();
        }
        return abort(404);
    }
}
