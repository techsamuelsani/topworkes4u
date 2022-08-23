<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    public $email;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendLink(){
        request()->validate([
            'email' => 'required|string|email|max:100|unique:users',
        ]);
        $email=request()->email;
        $token_key = rand(1000000000,9999999999);
        $ver=App\EmailVerification::where('email',$email)->first();
        if($ver){}else{ $ver=new App\EmailVerification();  $ver->email=$email; }
        $ver->token=$token_key;
        $ver->save();
        $text="Here is your account registration link: http://lancerr.net/reg/$email/$token_key";
        Mail::raw($text, function ($message){
            global $email;

            $message->to(request()->email);
            $message->subject('New Account Registration');
        });
        return redirect('/register?msg=sent');
    }
    public function viewRegister($email,$token){
        $ver=App\EmailVerification::where('email',$email)->first();
        if($ver){
            if($ver->token==$token){
                return view('auth.registerr')->with('email',$email)->with('token',$token);
            }
        }
        return abort(404);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:100|unique:users',
            'username' => 'required|string|min:8|max:50|unique:users|min:5',
            'dob' => 'required|date',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'dob' => $data['dob'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
