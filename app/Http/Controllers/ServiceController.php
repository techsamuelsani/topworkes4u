<?php

namespace App\Http\Controllers;
use App;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index','viewService','how');
        $this->middleware('redirectIfAdmin');
        $this->middleware('checkSeller')->except('index','viewService','how');
    }
    
    public function how(){
    return view('how'); }
    
    public function index($page=1)
    {
        $parameters=str_replace(url()->current(),"",url()->full());
        if($page<1){$page=1;}
         $cats=App\Category::all(); $services=new Collection();
        $rangeStart=5; $rangeEnd=999; $isRange=false; $isOnline=false; $isHighrated=false; $isSearch=false;

        if(count(request()->all())){
            if(request()->online){
                $isOnline=true;
            }

            if(request()->search){
                $isSearch=true;
                $keyword=request()->search;
            }

            if(request()->rating){
                $isHighrated=true;
            }

            if(request()->range){
                $isRange=true;
                $range=request()->range;
                $rangeEnd = substr($range, strpos($range, ",") + 1);
                $rangeStart=strtok($range, ',');
                $rangeEnd =$rangeEnd/1;
                $rangeStart=$rangeStart/1;
            }
            $selected=new Collection();
            foreach ($cats as $cat){
             $name = preg_replace('/\s+/', '_', $cat->name);
             if(request()->$name){}else{ $cats->forget(($cat->id)-1);}
            }

            if(count($cats)){}else{ $cats=App\Category::all();}


            foreach ($cats as $cat){
                if(count($cat->services)) {
                    $selected=$selected->merge($cat->services);
                }
            }
            $services=$selected;


            //keyword match
            if($isSearch) {
                $tagsArray = explode(' ', $keyword);
                $tags=App\Tag::select('service_id')->whereIn('tag', $tagsArray)->get();
                $tagss=new Collection();
                foreach ($tags as $tag){$tagss->push($tag->service_id);}
                $tagss=$tagss->toArray();
                $services=$services->whereIn('id',$tagss);
            }
            //keyword match
        }else{
            $services=App\Service::where('isVerified',1)->get();
        }
        $services=$services->where('isVerified',1);

        if($isRange) {
            foreach ($services as $service) {
                $price = $service->packages->first()->price;
                if ($price >= $rangeStart && $price <= $rangeEnd) {
                } else {
                    $services=$services->where('id','!=',$service->id);
                }
            }
        }

        if($isOnline) {
            foreach ($services as $service) {
                if ($service->user->isOnline()) {
                } else {
                    $services=$services->where('id','!=',$service->id);
                
                }
            }
        }

        if($isHighrated) {
            foreach ($services as $service) {
                if ($service->user->averageRating()>4.8) {
                } else {
                    $services=$services->where('id','!=',$service->id);
                
                }
            }
        }

        $count=count($services);

        $services=$services->shuffle();
        //pagination
        $page-=1;
        if(count($services)){
        while(!count($servs=$services->splice((10*$page),10))){
            $page-=1;
        }}else {
            $servs = $services;
        }
        //pagination
        $page+=1;
        return view('services')->with('services',$servs)->with('count',$count)->with('page',$page)->with('parameters',$parameters);
    }

    public function showAddForm($username)
    {
        $user=Auth::user();
        if($username!=$user->username) {
            return abort(404);
        }else {
            return view('dashboard.uploadService');
        }
    }
    public function saveService($username)
    {
        $userId=Auth::id();
        $user=Auth::user();
        if($username!=$user->username) {
            return abort(404);
        }
        request()->validate([
            'categoryId' => 'required|exists:categories,id',
            'title'=> 'required|string|max:50|min:10',
            'tags'=> 'required|string',
            'details'=> 'required|string|min:15',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'detail'=> 'required|string|min:15',
            'price'=> 'required|integer|min:5',
            'days'=> 'required|integer|min:1',
            'revisions'=> 'required|integer|min:1',
        ]);

        $tags=request()->tags;
        $tagsArray = explode(',', $tags);
        $tagsArray=array_slice($tagsArray, 0, 5);
        $imageName = $userId."_".time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('image'), $imageName);
        $service=new App\Service;
        $service->title=request()->title;
        $service->imgLink=$imageName;
        $service->details=request()->details;
        $service->category_id=request()->categoryId;
        $service->user_id=$userId;
        $service->save();
        $package=new App\Package;
        $package->price=request()->price;
        $package->revisions=request()->revisions;
        $package->detail=request()->detail;
        $package->days=request()->days;
        $package->service_id=$service->id;
        $package->save();
        foreach ($tagsArray as $tagg){
            $tag=new App\Tag;
            $tag->tag=$tagg;
            $tag->service_id=$service->id;
            $tag->save();


        }
        return redirect("/".$username."/services/manage");
    }

    public function manage($username){
        $user=Auth::user();
        if($username!=$user->username) {
            return abort(404);
        }
        $services=$user->services;
        return view('dashboard.manageServices')->with("services",$services);
    }

    public function viewService($username,$title,$id){
                    $title = preg_replace('/_/', ' ', $title);
                    $userr=App\User::where('username',$username)->first();
                    if($userr){
                    $service=$userr->services()->where('id',$id)->where('title',$title)->first();
                    if($service){
                        if($service->isVerified==1) {
                            $service->views = $service->views + 1;
                            $service->save();
                            return view('service')->with('service', $service);
                        }

                    }}
                    return abort(404);
    }
    public function showUpdate($username,$title,$id){
        $title = preg_replace('/_/', ' ', $title);
        $userr=Auth::user();
        if($username!=$userr->username) {
            return abort(404);
        }
        $service=$userr->services()->where('id',$id)->where('title',$title)->first();
        if($service && $userr->username==$username){
            return view('dashboard.updateService')->with('service',$service);

        }else{ return abort(404);}
    }
    public function updateService($username,$title,$id){
        $title = preg_replace('/_/', ' ', $title);
        $userr=Auth::user();
        if($username!=$userr->username) {
            return abort(404);
        }
        $service=$userr->services()->where('id',$id)->where('title',$title)->first();
        if($service && $userr->username==$username){
            request()->validate([
                'categoryId' => 'required|exists:categories,id',
                'title'=> 'required|string|max:50|min:10',
                'tags'=> 'required|string',
                'details'=> 'required|string|min:15',
            ]);
            $tags=request()->tags;
            $tagsArray = explode(',', $tags);
            $tagsArray=array_slice($tagsArray, 0, 5);

            $service->title=request()->title;
            $service->details=request()->details;
            $service->category_id=request()->categoryId;
            $service->isVerfied=null;
            $service->save();
            $tagss=$service->tags;
            foreach ($tagss as $ta){ $ta->delete();}

            foreach ($tagsArray as $tagg){
                $tag=new App\Tag;
                $tag->tag=$tagg;
                $tag->service_id=$service->id;
                $tag->save();
            }

            return redirect()->back();

        }else{ return abort(404);}
    }
    public function imageUpdate($username,$title,$id){
        $title = preg_replace('/_/', ' ', $title);
        $userr=Auth::user();
        $service=$userr->services()->where('id',$id)->where('title',$title)->first();
        if($service && $userr->username==$username){
            request()->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if($service->imgLink != null) {
                unlink('image/' . $service->imgLink);
            }
            $imageName = $userr->id."_".time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('image'), $imageName);
            $service->imgLink=$imageName;
            $service->isVerfied=null;
            $service->save();
            return redirect()->back();

        }else{ return abort(404);}
    }
    public function packageUpdate($username,$title,$id,$number){
        $title = preg_replace('/_/', ' ', $title);
        $userr=Auth::user();
        $service=$userr->services()->where('id',$id)->where('title',$title)->first();
        if($service && $userr->username==$username && $number<=3){

            request()->validate([
                'detail'=> 'required|string|min:15',
                'price'=> 'required|integer|min:5',
                'days'=> 'required|integer|min:1',
                'revisions'=> 'required|integer|min:1',
            ]);
            if($number==1){
                $package=$service->packages->first();
                $package->price=request()->price;
                $package->days=request()->days;
                $package->detail=request()->detail;
                $package->revisions=request()->revisions;
                $package->save();
                return redirect()->back();
            }
            $packages=$service->packages;
            $count=count($packages);
            if($number==2 && $count>=2){
                $package=$packages[1];
                $package->price=request()->price;
                $package->days=request()->days;
                $package->detail=request()->detail;
                $package->revisions=request()->revisions;
                $package->save();
            }else if($number==2){
                $package= new App\Package;
                $package->price=request()->price;
                $package->days=request()->days;
                $package->service_id=$service->id;
                $package->detail=request()->detail;
                $package->revisions=request()->revisions;
                $package->save();
            }

            if($number==3 && $count>=3){
                $package=$packages[2];
                $package->price=request()->price;
                $package->days=request()->days;
                $package->detail=request()->detail;
                $package->revisions=request()->revisions;
                $package->save();
            }else if($number==3){
                $package= new App\Package;
                $package->price=request()->price;
                $package->days=request()->days;
                $package->service_id=$service->id;
                $package->detail=request()->detail;
                $package->revisions=request()->revisions;
                $package->save();
            }
            return redirect()->back();




        }else{ return abort(404);}
    }
    public function deleteService($username,$title,$id){
        $title = preg_replace('/_/', ' ', $title);
        $userr=Auth::user();
        $service=$userr->services()->where('id',$id)->where('title',$title)->first();
        if($service && $userr->username==$username){
            $service->delete();
            return redirect()->back();
        }else{ return abort(404);}
    }




}
