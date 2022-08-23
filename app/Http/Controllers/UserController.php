<?php

namespace App\Http\Controllers;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
        $this->middleware('redirectIfAdmin')->except(['showSettings','showSettings','changePassword','uploadImage']);
        $this->middleware('checkSeller')->only('sales');
    }
    public function index($username){
        $user= \App\User::where('username',$username)->first();
        if($user) {
            return view('profile')->with('user', $user);
        }else{
            return abort(404);
        }
    }


    public function showSettings($username){
        $user=Auth::User();
        if($username==$user->username) {
            return view('dashboard.settings')->with('user', $user);
        }else{
            return abort(404);
        }
    }


    public function uploadImage($username){
        $user=Auth::User();
        if($username==$user->username) {
            request()->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if($user->picLink != "default.jpg") {
                unlink('image/' . $user->picLink);
            }
            $imageName = $user->id."_".time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('image'), $imageName);
            $user->picLink=$imageName;
            $user->save();
            return redirect()->back();
        }else{
            return abort(404);
        }
    }

    public function saveSettings($username){
        $user=Auth::User();
        if($username==$user->username) {
            request()->validate([
                'name' => 'required|string|max:255',
                'country' => 'required|string',
                'city' => 'required|string',
                'state' => 'required|string',
                'address' => 'required|string',
                'zip' => 'required|string',
                'phone' => 'required|string',
                'dob' => 'required|date',
            ]);
            if(request()->email !=$user->email){
                request()->validate([
                    'email' => 'required|string|email|max:100|unique:users',
                ]);
            }
            if(request()->username !=$user->username){
                request()->validate([
                    'username' => 'required|string|max:50|unique:users|min:8',
                ]);
            }
            $user->name=request()->name;
            $user->username=request()->username;
            $user->country=request()->country;
            $user->city=request()->city;
            $user->state=request()->state;
            $user->address=request()->address;
            $user->zip=request()->zip;
            $user->phone=request()->phone;
            $user->dob=request()->dob;
            $user->email=request()->email;
            $user->save();
            
            return redirect()->back();
        }else{
            return abort(404);
        }
    }

    public function changePassword($username,Request $request){
        $user=Auth::User();
        if($username==$user->username) {
            request()->validate([
                'old_password'=>'required|string',
                'password' => 'required|string|min:6|confirmed',
            ]);
           if(Hash::check(request()->old_password, $user->password)){
               $user->password=Hash::make(request()->password);
               $user->save();
               return redirect()->back();
           }else{
               $request->session()->flash('alert', 'Wrong Old password');
               return redirect()->back();
           }

        }else{
            return abort(404);
        }
    }

    public function purchases($username){
        $user=Auth::User();
        if($username==$user->username) {
            return view('dashboard.purchases')->with('user', $user);
        }else{
            return abort(404);
        }
    }

    public function sales($username){
        $user=Auth::User();
        if($username==$user->username) {
            return view('dashboard.sales')->with('user', $user);
        }else{
            return abort(404);
        }
    }

    public function becomeSeller($username){
        $user=Auth::User();
        if($username==$user->username){
            $user->status=3;
            $user->save();
            return redirect()->back();
        }else{
            return abort(404);
        }
    }



}
