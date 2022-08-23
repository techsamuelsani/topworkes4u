<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;
use Storage;

class OrderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('redirectIfAdmin');
    }

    public function verify(){
        request()->validate([
            'key' => 'required|string|max:50|unique:payments',
            'order_number' => 'required|string|max:50|unique:payments',
            'invoice_id' => 'required|string|max:50|unique:payments',
            'total' => 'required|string',
            'currency_code' => 'required|string',
        ]);

        $user=Auth::User();

        $hashSecretWord = 'OGJmZWNlZTYtODUxZi00YWY0LWFhZWQtOTEwMjk3NjdmZDRl'; //2Checkout Secret Word
        $hashSid = 901394469; //2Checkout account number
        $hashTotal = request()->total; //Sale total to validate against
        $hashOrder = request()->order_number; //2Checkout Order Number
        $StringToHash = strtoupper(md5($hashSecretWord . $hashSid . $hashOrder . $hashTotal));
        $type=request()->li_0_name;
        $id=substr($type, 1);
        $type=$type[0];
        if ($StringToHash != request()->key) {
            $result = 'Fail - Hash Mismatch';
            return abort(404);

        } else { $result = 'Success - Hash Matched';
            $order=new App\Order;
            if($type=="p") {
                $package=App\Package::find($id);
                if($package){
                if($package->price<=request()->li_0_price){
                $order->type = "package";
                $order->package_id = $id;
                $order->user_id=$user->id;
                $order->save();}else{ return abort(404); }
                }else{ return abort(404); }

            } elseif($type=="o") {
                $offer=App\Offer::find($id);
                if($offer) {
                    if($offer->price==request()->li_0_price){
                    $order->type = "offer";
                    $order->offer_id = $id;
                    $order->user_id = $user->id;
                    $order->save(); }else{ return abort(404); }
                }else{ return abort(404); }
            }else{ return abort(404); }

            $payment=new App\Payment;
            $payment->order_id=$order->id;
            $payment->key=request()->key;
            $payment->order_number=request()->order_number;
            $payment->currency_code=request()->currency_code;
            $payment->invoice_id=request()->invoice_id;
            $payment->total=request()->total;
            $payment->save();
            $notification=App\Notification::where('link', "/".$order->seller()->username."/selling/".$order->id)->delete();
            $notification =new App\Notification;
            $notification->user_id=$order->seller()->id;
            $notification->title=" You got a new order";
            $notification->body='There is new order for "'.$order->service()->title.'"';
            $notification->link="/".$order->seller()->username."/selling/".$order->id;
            $notification->save();
            return redirect('/'.$user->username.'/buying/'.$order->id);


        }
    }

    public function sellerView($username,$id){
        $user=Auth::User();
        if($username==$user->username)
        {
            $order=App\Order::find($id);
            if($order){
                if($order->seller()->id==$user->id)
                {
                    $ref="o".$order->id;
                    $messages=App\Message::where('reference',$ref)->orderBy('created_at', 'asc')->get();
                    return view('order')->with('order',$order)->with('messages',$messages);
                }
            }
        }
        return abort(404);
    }

    public function buyerView($username,$id){
        $user=Auth::User();
        if($username==$user->username)
        {

            $order=App\Order::find($id);
            if($order){

                if($order->buyer->id==$user->id)
                {
                    $ref="o".$order->id;
                    $messages=App\Message::where('reference',$ref)->orderBy('created_at', 'asc')->get();
                    return view('orderView')->with('order',$order)->with('messages',$messages);
                }
            }
        }
        return abort(404);
    }

    public function deliver($username,$id){
        $user=Auth::User();
        if($username==$user->username)
        {
            $order=App\Order::find($id);
            if($order){
                if($order->seller()->id==$user->id && $order->stuts!= "completed" && $order->stuts!= "0")
                {
                    request()->validate([
                        'comment' => 'required|string',
                    ]);
                    $delivery=new App\Delivery;
                    $delivery->order_id=$order->id;
                    $delivery->comment=request()->comment;
                    if(request()->file){
                        request()->validate([
                            'file' => 'required|mimes:zip',
                        ]);
                        $fileName = $user->id."_".time().'.'.request()->file->getClientOriginalExtension();
                        Storage::put($fileName, file_get_contents(request()->file));
                        //request()->file->move(public_path('/app/files/'), $fileName);
                        $delivery->fileLink=$fileName;
                    }

                    $delivery->save();
                    $order->status="delivered";
                    $order->save();
                    $notification=App\Notification::where('link', "/".$order->buyer->username."/buying/".$order->id)->delete();
                    $notification =new App\Notification;
                    $notification->user_id=$order->buyer->id;
                    $notification->title="Order Received";
                    $notification->body='Order "'.$order->service()->title.'" received';
                    $notification->link="/".$order->buyer->username."/buying/".$order->id;
                    $notification->save();
                    return redirect()->back();
                }
            }
        }
        return abort(404);
    }

    public function action($username,$id){
        $user=Auth::User();
        if($username==$user->username)
        {
            $order=App\Order::find($id);
            if($order){
                if($order->buyer->id==$user->id)
                {
                    if(request()->redeliver){
                        if($order->status == "delivered" && ($order->availableRevisions() > $order->revisions)) {
                            $order->status = "redeliver";
                            $order->revisions+=1;
                            $order->save();
                            $notification=App\Notification::where('link', "/".$order->seller()->username."/selling/".$order->id)->delete();
                            $notification =new App\Notification;
                            $notification->user_id=$order->seller()->id;
                            $notification->title=" Buyer asked for redelivery";
                            $notification->body='The buyers asked for some changes for order "'.$order->service()->title.'"';
                            $notification->link="/".$order->seller()->username."/selling/".$order->id;
                            $notification->save();

                        }
                     }
                    elseif(request()->accept){
                        $order->status="completed";
                        $order->seller()->balance+=($order->payment->total)*0.9;
                        $order->seller()->save();
                        $order->save();
                        
                        $notification=App\Notification::where('link', "/".$order->seller()->username."/selling/".$order->id)->delete();
                        $notification =new App\Notification;
                        $notification->user_id=$order->seller()->id;
                        $notification->title="Order Completed";
                        $notification->body='The buyers marked as completed to "'.$order->service()->title.'"';
                        $notification->link="/".$order->seller()->username."/selling/".$order->id;
                        $notification->save();
                    } elseif(request()->cancel){
                        if($order->status=="0") {
                            $order->status = "canceled";
                            $order->save();
                            $order->buyer->balance+=($order->payment->total);
                            $order->buyer->save();
                            $notification=App\Notification::where('link', "/".$order->seller()->username."/selling/".$order->id)->delete();
                            $notification =new App\Notification;
                            $notification->user_id=$order->seller()->id;
                            $notification->title="Order has been canceled";
                            $notification->body='The order "'.$order->service()->title.'" has been canceled';
                            $notification->link="/".$order->seller()->username."/selling/".$order->id;
                            $notification->save();
                            $notification=App\Notification::where('link', "/".$order->buyer->username."/buying/".$order->id)->delete();
                            $notification =new App\Notification;
                            $notification->user_id=$order->buyer->id;
                            $notification->title="Order has been canceled";
                            $notification->body='The order "'.$order->service()->title.'" has been canceled';
                            $notification->link="/".$order->buyer->username."/buying/".$order->id;
                            $notification->save();
                        }
                    }
                    return redirect()->back();
                }
            }
        }
        return abort(404);
    }

    public function sellerAction($username,$id){
        $user=Auth::User();
        if($username==$user->username)
        {
            $order=App\Order::find($id);
            if($order){
                if($order->seller()->id==$user->id)
                {

                    if(request()->accept){
                        $order->status="started";
                        $order->save();
                        $notification=App\Notification::where('link', "/".$order->buyer->username."/buying/".$order->id)->delete();
                        $notification =new App\Notification;
                        $notification->user_id=$order->buyer->id;
                        $notification->title="Order has been started";
                        $notification->body='The order "'.$order->service()->title.'" has been started';
                        $notification->link="/".$order->buyer->username."/buying/".$order->id;
                        $notification->save();
                    } elseif(request()->cancel){
                        if($order->status=="0") {
                            $order->status = "canceled";
                            $order->save();
                            $order->buyer->balance+=$order->payment->total;
                            $order->buyer->save();
                            $notification=App\Notification::where('link', "/".$order->seller()->username."/selling/".$order->id)->delete();
                            $notification =new App\Notification;
                            $notification->user_id=$order->seller()->id;
                            $notification->title="Order has been canceled";
                            $notification->body='The order "'.$order->service()->title.'" has been canceled';
                            $notification->link="/".$order->seller()->username."/selling/".$order->id;
                            $notification->save();
                            $notification=App\Notification::where('link', "/".$order->buyer->username."/buying/".$order->id)->delete();
                            $notification =new App\Notification;
                            $notification->user_id=$order->buyer->id;
                            $notification->title="Order has been canceled";
                            $notification->body='The order "'.$order->service()->title.'" has been canceled';
                            $notification->link="/".$order->buyer->username."/buying/".$order->id;
                            $notification->save();
                        }
                    }
                    return redirect()->back();
                }
            }
        }
        return abort(404);
    }

    public function saveMessage($username,$id){
        $user=Auth::User();
        if($username==$user->username)
        {
            $order=App\Order::find($id);
            if($order){
                if($order->seller()->id==$user->id || $order->buyer->id==$user->id)
                {
                    request()->validate([
                        'body' => 'required|string',
                        'reference'=> 'required|string',
                    ]);
                    if($_POST['file']){
                        request()->validate([
                            'file' => 'required|mimes:zip',
                        ]);
                    }
                    $reference=request()->reference;
                    $id=substr($reference, 1);
                    if($order->id==$id) {

                        $message = new App\Message;
                        $message->body = request()->body;
                        $message->reference = request()->reference;
                        if($order->seller()->id==$user->id) {
                            $message->receiver_id = $order->buyer->id;
                            $notification=App\Notification::where('link', "/".$order->buyer->username."/buying/".$order->id)->delete();
                            $notification =new App\Notification;
                            $notification->user_id=$order->buyer->id;
                            $notification->title="There is new message on order";
                            $notification->body='The order "'.$order->service()->title.'" has new message';
                            $notification->link="/".$order->buyer->username."/buying/".$order->id;
                            $notification->save();

                        }else{
                            $message->receiver_id = $order->seller()->id;
                            
                            $notification=App\Notification::where('link', "/".$order->seller()->username."/selling/".$order->id)->delete();
                            $notification =new App\Notification;
                            $notification->user_id=$order->seller()->id;
                            $notification->title="There is new message on order";
                            $notification->body='The order "'.$order->service()->title.'" has new message';
                            $notification->link="/".$order->seller()->username."/selling/".$order->id;
                            $notification->save();
                        }
                        $message->sender_id = $user->id;
                        $message->save();

                        return redirect()->back();
                    }


                }
            }
        }
        return abort(404);
    }

    public function writeReview($username,$id){
        $user=Auth::User();
        if($username==$user->username)
        {
            $order=App\Order::find($id);
            if($order){
                if($order->buyer->id==$user->id && $order->status="completed" && !$order->review)
                {
                    $val=[
                        'comment' => 'required|string|min:1',
                    ];
                    $cat=$order->service()->category;
                    $skills=$cat->skills;
                    foreach ($skills as $skill){
                        $name=$skill->name;
                        $name = preg_replace('/\s+/', '_', $name);
                        $temp=[
                            $name => 'required|integer|max:5|min:0',
                        ];
                        $val=array_merge($val, $temp);
                    }
                    request()->validate($val);
                    $review=new App\Review;
                    $review->comment=request()->comment;
                    $review->order_id=$order->id;
                    $review->save();
                    foreach ($skills as $skill){
                        $name=$skill->name;
                        $name = preg_replace('/\s+/', '_', $name);
                        $rating=new App\Rating;
                        $rating->review_id=$review->id;
                        $rating->rating=request()->$name;
                        $rating->skill_id=$skill->id;
                        $rating->save();
                    }
                    
                    $notification=App\Notification::where('link', "/".$order->seller()->username."/selling/".$order->id)->delete();
                    $notification =new App\Notification;
                    $notification->user_id=$order->seller()->id;
                    $notification->title="You got a review";
                    $notification->body='The buyer wrote a review on order "'.$order->service()->title.'"';
                    $notification->link="/".$order->seller()->username."/selling/".$order->id;
                    $notification->save();
                   return redirect()->back();


                }
            }
        }
        return abort(404);
    }

    public function balanceBuy($username,$title,$id)
    {
        $user=Auth::User();  $total=0;
        $title = preg_replace('/_/', ' ', $title);
        $userr = App\User::where('username', $username)->first();
        if ($userr) {
            $service = $userr->services()->where('id', $id)->where('title', $title)->first();
            if ($service) {

                request()->validate([
                    'li_0_name' => 'required|string',
                ]);
                $type = request()->li_0_name;
                $id = substr($type, 1);
                $type = $type[0];
                { $result = 'Success - Hash Matched';
                    $order=new App\Order;
                    if($type=="p") {
                        $package=App\Package::find($id);
                        if($package){
                            if($package->price<=$user->balance){
                                $total=$package->price;
                                $order->type = "package";
                                $order->package_id = $id;
                                $order->user_id=$user->id;
                                $order->save();
                                $user->balance-=$total;
                                $user->save();
                            }else{ return redirect()->back(); }
                        }else{ return abort(404); }

                    } else{ return abort(404); }
                    $key="balance_".$user->id."_".time();
                    $payment=new App\Payment;
                    $payment->order_id=$order->id;
                    $payment->key=$key;
                    $payment->order_number=$key;
                    $payment->currency_code="USD";
                    $payment->invoice_id=$key;
                    $payment->total=$total;
                    $payment->save();
                    $notification=App\Notification::where('link', "/".$order->seller()->username."/selling/".$order->id)->delete();
                    $notification =new App\Notification;
                    $notification->user_id=$order->seller()->id;
                    $notification->title=" You got a new order";
                    $notification->body='There is new order for "'.$order->service()->title.'"';
                    $notification->link="/".$order->seller()->username."/selling/".$order->id;
                    $notification->save();
                    return redirect('/'.$user->username.'/buying/'.$order->id);


                }


            }


        }
        return abort(404);
    }

    public function offerBuy($id)
    {
        $user=Auth::User();  $total=0;
            $offer = App\Offer::find($id);
            if ($offer) {

                request()->validate([
                    'li_0_name' => 'required|string',
                ]);
                $type = request()->li_0_name;
                $id = substr($type, 1);
                $type = $type[0];
                { $result = 'Success - Hash Matched';
                    $order=new App\Order;
                   if($type=="o") {
                        if($offer) {
                            if($offer->price<=$user->balance){
                                $total=$offer->price;
                                $order->type = "offer";
                                $order->offer_id = $id;
                                $order->user_id = $user->id;
                                $order->save();
                                $user->balance-=$total;
                                $user->save();
                            }else{ return redirect()->back(); }
                        }else{ return abort(404); }
                    }else{ return abort(404); }
                    $key="balance_".$user->id."_".time();
                    $payment=new App\Payment;
                    $payment->order_id=$order->id;
                    $payment->key=$key;
                    $payment->order_number=$key;
                    $payment->currency_code="USD";
                    $payment->invoice_id=$key;
                    $payment->total=$total;
                    $payment->save();
                    $notification=App\Notification::where('link', "/".$order->seller()->username."/selling/".$order->id)->delete();
                    $notification =new App\Notification;
                    $notification->user_id=$order->seller()->id;
                    $notification->title=" You got a new order";
                    $notification->body='There is new order for "'.$order->service()->title.'"';
                    $notification->link="/".$order->seller()->username."/selling/".$order->id;
                    $notification->save();
                    return redirect('/'.$user->username.'/buying/'.$order->id);



                }


            }

        return abort(404);
    }
}