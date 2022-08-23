<?php
use Illuminate\Database\Eloquent\Collection;
if(Auth::check()) {

	$user = Auth::User();
	$nots=new Collection();
	$msgs=new Collection();
	$notifications=$user->notifications;
	$notifications=$notifications->sortByDesc('created_at');
	$notifications=$notifications->groupBy('title')->groupBy('link');
	foreach($notifications as $notificationnn){ foreach ($notificationnn as $notificationn) { foreach ($notificationn as $notification){
	$nots->push($notification);
	}}}
	$nots=$nots->take(7);
	$nots=$nots->reverse();
    $me=$user; $infor=new Collection();
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
    $lastId=1;
    $ids=array_unique($ids);
    $ids = array_slice($ids, 0, 5);
    foreach($ids as $id){

                        if($me->id!=$id){
                            $userr=App\User::find($id);
                            $message=App\Message::where([
                                ['sender_id',$me->id],
                                ['receiver_id',$userr->id],
                                ['reference',null],
                            ])->orWhere([
                                ['sender_id',$userr->id],
                                ['receiver_id',$me->id],
                                ['reference',null],
                            ])->orderBy('created_at', 'desc')->first();
                    		 $msgs->push($message);
                    }}
}
?>
<!DOCTYPE html>
<link rel="stylesheet" href="css\vendor\magnific-popup.css">
<div class="header-wrap">
	<div id="help" style="display: none; position: absolute; box-shadow: 0px 0px 20px #21282a; z-index: 9999; top:150px; left: 35%;">
		<div class="mfp-bg mfp-fade mfp-ready"></div>
		<div class="mfp-wrap mfp-close-btn-in mfp-auto-cursor mfp-fade mfp-ready" tabindex="-1" style="overflow-x: hidden; overflow-y: auto;"><div class="mfp-container mfp-s-ready mfp-inline-holder"><div class="mfp-content"><div id="new-message-popup" class="form-popup new-message">
						<!-- FORM POPUP CONTENT -->
						<div class="form-popup-content">
							<center><h4 class="popup-title">Open a new ticket</h4></center>
							<!-- LINE SEPARATOR -->
							<hr class="line-separator">
							<!-- /LINE SEPARATOR -->
							<form method="post" action="/open/ticket" ENCTYPE="multipart/form-data" class="new-message-form">
								@csrf
								<div style="float: left; margin-bottom: 0px; width: 99%; padding: 5px;" class="input-container">
									<label for="title" class="rl-label required">Title</label>
									<input type="text" id="title" required name="title" placeholder="Enter title here...">
								</div>
								<div class="clearfix"></div>
								<div style="float: left; width: 99%; margin-bottom: 5px; padding: 5px;" class="input-container">
									<label for="price" class="rl-label required">Details</label>
									<textarea style="max-height: 100px; " id="details" required name="details" placeholder="Enter Details..."></textarea>
								</div>
								<div class="clearfix"></div>
								<div style="float: left; width: 99%; margin-bottom: 5px; padding: 5px;" class="input-container">
									<label for="price" class="rl-label">Select File</label>
									<input type="file" id="title" required name="file" >
								</div>


								<input type="submit" class="button mid dark" name="action" value="Open Ticket">
							</form>
						</div>
						<!-- /FORM POPUP CONTENT -->
						<a onclick="cclose()" style="margin: 30px; padding: 12px;" class="close-btn mfp-close"><span style="color: white; position: absolute; font-size: 26px; left: 10px;">X</span></a>
					</div></div></div></div>
	</div>
	<header>
		<!-- LOGO -->
		<a href="/">
			<figure class="logo">
				<img src="\images\logo.png" alt="logo">
			</figure>
		</a>
		<!-- /LOGO -->

		<!-- MOBILE MENU HANDLER -->
		<div class="mobile-menu-handler left primary">
			<img src="\images\pull-icon.png" alt="pull-icon">
		</div>
		<!-- /MOBILE MENU HANDLER -->

		<!-- LOGO MOBILE -->
		<a href="/">
			<figure class="logo-mobile">
				<img src="\images\logo_mobile.png" alt="logo-mobile">
			</figure>
		</a>
		<!-- /LOGO MOBILE -->

		<!-- MOBILE ACCOUNT OPTIONS HANDLER -->
		<div class="mobile-account-options-handler right secondary">
			<span class="icon-user"></span>
		</div>
		<!-- /MOBILE ACCOUNT OPTIONS HANDLER -->
@if(Auth::check())
		<!-- USER BOARD -->
		<div class="user-board">
			<!-- USER QUICKVIEW -->
			<div class="user-quickview">
				<!-- USER AVATAR -->
				<a href="\{{$user->username}}">
					<div class="outer-ring">
						<div class="inner-ring"></div>
						<figure class="user-avatar">
							<img style="height: 40px; width: 40px;" src="\image\{{$user->picLink}}" alt="avatar">
						</figure>
					</div>
				</a>
				<!-- /USER AVATAR -->

				<!-- USER INFORMATION -->
				<p class="user-name">{{$user->name}}</p>
				<!-- SVG ARROW -->
				<svg class="svg-arrow">
					<use xlink:href="#svg-arrow"></use>
				</svg>
				<!-- /SVG ARROW -->
				<p class="user-money">${{$user->balance}}</p>
				<!-- /USER INFORMATION -->

				<!-- DROPDOWN -->
				<ul class="dropdown small hover-effect closed">
					<li class="dropdown-item">
						<div class="dropdown-triangle"></div>
						<a href="/{{$user->username}}">Profile Page</a>
					</li>
					<li class="dropdown-item">
						<a href="/{{$user->username}}/settings">Account Settings</a>
					</li>
					<li class="dropdown-item">
						<a href="/{{$user->username}}/purchases">Your Purchases</a>
					</li>
					<li class="dropdown-item">
						<a href="/jobs/manage">Jobs posted by me</a>
					</li>
					<li class="dropdown-item">
						<a href="/{{$user->username}}/recharge">Recharge</a>
					</li>
					<li class="dropdown-item">
						<a href="/{{$user->username}}/withdrawals">Withdrawals</a>
					</li>
					@if($user->type=="seller")
					<li class="dropdown-item">
						<a href="/{{$user->username}}/sales">Your Sales</a>
					</li>
					<li class="dropdown-item">
						<a href="/{{$user->username}}/services/manage">Manage Services</a>
					</li>
					@endif
					<li class="dropdown-item">
						<a href="/tickets">My Support Tickets</a>
					</li>
				</ul>
				<!-- /DROPDOWN -->
			</div>
			<!-- /USER QUICKVIEW -->

			<!-- ACCOUNT INFORMATION -->
			<div class="account-information">
				<div class="account-cart-quickview">
						<span style="font-size:20px; padding-top:5px;" class="icon-bell">
						</span>

					<!-- PIN -->
					<script> var coun={{count($nots->where('isSeen',0))}}; </script>
					<span id="notC" class="pin soft-edged secondary">{{count($nots->where('isSeen',0))}}</span>
					<!-- /PIN -->

					<!-- DROPDOWN CART -->
					<ul id='not' class="dropdown cart closed">
				
						@foreach($nots as $notification) 
						<?php $lastId=$notification->id;  ?>
					
						<!-- DROPDOWN ITEM -->
                        <li style="padding-left: 15px; padding-top: 5px; padding-bottom: 10px; height: auto; @if($notification->isSeen!=0) background-color: #d4d4d4; @endif " class="dropdown-item">
                            <a href="{{$notification->link}}" class="link-to"></a>
                            <!-- SVG PLUS -->
                            <svg class="svg-plus">
                                <use xlink:href="#svg-plus"></use>
                            </svg>
                            <!-- /SVG PLUS -->
                            <div class="dropdown-triangle"></div>

                            <p class="text-header tiny">{{$notification->title}}</p>
                            <p class="category tiny primary">{{$notification->body}}</p>

                        </li>
                        <!-- /DROPDOWN ITEM -->
                     
						@endforeach
						

							<a style="width: 50%; border-radius: 0px;" href="/{{$user->username}}/purchases" class="button primary half">View All Buyings</a>
							<a style="width: 50%; border-radius: 0px;" href="/{{$user->username}}/sales" class="button secondary half">View All Sellings</a>

					</ul>
					<!-- /DROPDOWN CART -->
				</div>
				<div class="account-email-quickview">
						<span class="icon-envelope">
							<!-- SVG ARROW -->
							<svg class="svg-arrow">
								<use xlink:href="#svg-arrow"></use>
							</svg>
							<!-- /SVG ARROW -->
						</span>

					<!-- PIN -->
					<span class="pin soft-edged secondary">{{count($msgs->where('isSeen',0)->where('sender_id','!=',$me->id))}}</span>
					<!-- /PIN -->

					<!-- DROPDOWN NOTIFICATIONS -->
					<ul class="dropdown notifications closed">
						@foreach($msgs as $message)
                    
                    				<?php if($message->sender_id==$me->id){ 
                    				$u=App\User::find($message->receiver_id);
                    			
                    				?>
                   
						<li style="background-color: #d4d4d4;" class="dropdown-item">
							<div class="dropdown-triangle"></div>
							<a href="/{{$u->username}}/conversation" class="link-to"></a>
							<figure class="user-avatar">
								<img src="\image\{{$u->picLink}}" alt="">
							</figure>
							<p class="text-header tiny"><span>{{$u->name}}</span></p>
							<p style="height:15px; overflow:hidden;" class="subject">{{$message->body}}</p>
							<p class="timestamp">{{ date('F d, Y \a\t h:i a', strtotime($message->created_at)) }}</p>
						
							<span class="notification-type icon-action-undo"></span>
							


						</li>
						<!-- /DROPDOWN ITEM -->
						<?php } elseif($message->receiver_id==$me->id){ $u=App\User::find($message->sender_id); ?>
						<li style="@if($message->isSeen!=0) background-color: #d4d4d4; @endif" class="dropdown-item">
							<div class="dropdown-triangle"></div>
							<a href="/{{$u->username}}/conversation" class="link-to"></a>
							<figure class="user-avatar">
								<img src="\image\{{$u->picLink}}" alt="">
							</figure>
							<p class="text-header tiny"><span>{{$u->name}}</span></p>
							<p style="height:15px; overflow:hidden;" class="subject">{{$message->body}}</p>
							<p class="timestamp">{{ date('F d, Y \a\t h:i a', strtotime($message->created_at)) }}</p>
							@if($message->isSeen==1)
								<span class="notification-type icon-envelope-open"></span>
							@else
								<span class="notification-type icon-envelope"></span>
							@endif


						</li>

                        <?php } ?> @endforeach
						<a href="/inbox" style="width: 100%" class="button secondary">View all Messages</a>
					</ul>
					<!-- /DROPDOWN NOTIFICATIONS -->
				</div>

			</div>
			<!-- /ACCOUNT INFORMATION -->

			<!-- ACCOUNT ACTIONS -->
			<div class="account-actions">
				<a href="/job/add" class="button medium secondary">Post a Job</a>
				@if($user->type=="buyer"&& $user->status!=3 )
					<form style="display: inline; " action="{{$user->username}}/startSell" method="POST">
						@csrf
						<button style="margin-right: 10px;" class="button medium primary">Become a Seller</button>

					</form>
				@endif
				<form style="display: inline;" method="POST" action="{{ route('logout') }}">
					@csrf
					<input type="submit" name="submit" class="button secondary" value="Logout" ></form>
			</div>
			<!-- /ACCOUNT ACTIONS -->
		</div>
		<!-- /USER BOARD -->
@else
		<div class="user-board">
			<div class="account-actions">
				<a href="/login" class="button primary">Login</a>
				<a href="/register" class="button secondary">Register</a>

			</div>
		</div>
@endif

	</header>
</div>



<!-- SIDE MENU -->
<div id="mobile-menu" class="side-menu left closed">
	<!-- SVG PLUS -->
	<svg class="svg-plus">
		<use xlink:href="#svg-plus"></use>
	</svg>
	<!-- /SVG PLUS -->

	<!-- SIDE MENU HEADER -->
	<div class="side-menu-header">
		<figure class="logo small">
			<img src="\images\logo.png" alt="logo">
		</figure>
	</div>
	<!-- /SIDE MENU HEADER -->

	<!-- SIDE MENU TITLE -->
	<p class="side-menu-title">Main Links</p>
	<!-- /SIDE MENU TITLE -->

	<!-- DROPDOWN -->
	<ul class="dropdown dark hover-effect interactive">
		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="/">Home</a>
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="/view/services">Services</a>
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="/jobs">Jobs</a>
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="/how">How to Shop</a>
		</li>
		
		@if(Auth::check())
		@if($user->type=="seller")
		<li class="dropdown-item">
			<a href="/{{$user->username}}/services/manage">Manage Services</a>
		</li>
		@endif
	
		<li class="dropdown-item">
			<a onclick="sshow()" href="#">Help</a>
		</li>
		<!-- /DROPDOWN ITEM -->
		@endif


	</ul>
	<!-- /DROPDOWN -->
</div>
<!-- /SIDE MENU -->

<!-- SIDE MENU -->
<div id="account-options-menu" class="side-menu right closed">
	@if(Auth::check())
	<!-- SVG PLUS -->
	<svg class="svg-plus">
		<use xlink:href="#svg-plus"></use>
	</svg>
	<!-- /SVG PLUS -->

	<!-- SIDE MENU HEADER -->
	<div class="side-menu-header">
		<!-- USER QUICKVIEW -->
		<div class="user-quickview">
			<!-- USER AVATAR -->
			<a href="author-profile.html">
				<div class="outer-ring">
					<div class="inner-ring"></div>
					<figure class="user-avatar">
						<img src="\images\avatars\avatar_01.jpg" alt="avatar">
					</figure>
				</div>
			</a>
			<!-- /USER AVATAR -->

			<!-- USER INFORMATION -->
			<p class="user-name">{{ $user->name }}</p>
			<p class="user-money">${{ $user->balance }}</p>
			<!-- /USER INFORMATION -->
		</div>
		<!-- /USER QUICKVIEW -->
	</div>
	<!-- /SIDE MENU HEADER -->

	<!-- SIDE MENU TITLE -->
	<p class="side-menu-title">Your Account</p>
	<!-- /SIDE MENU TITLE -->

	<!-- DROPDOWN -->
	<ul class="dropdown dark hover-effect">
		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="dashboard-notifications.html">Notifications</a>
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="/inbox">Messages</a>
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="cart.html">Your Cart</a>
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="favourites.html">Favourites</a>
		</li>
		<!-- /DROPDOWN ITEM -->
	</ul>
	<!-- /DROPDOWN -->

	<!-- SIDE MENU TITLE -->
	<p class="side-menu-title">Dashboard</p>
	<!-- /SIDE MENU TITLE -->

	<!-- DROPDOWN -->
	<ul class="dropdown dark hover-effect">
		<li class="dropdown-item">
			<div class="dropdown-triangle"></div>
			<a href="/{{$user->username}}">Profile Page</a>
		</li>
		<li class="dropdown-item">
			<a href="/{{$user->username}}/settings">Account Settings</a>
		</li>
		<li class="dropdown-item">
			<a href="/{{$user->username}}/purchases">Your Purchases</a>
		</li>
		<li class="dropdown-item">
			<a href="/jobs/manage">Jobs posted by me</a>
		</li>
		<li class="dropdown-item">
			<a href="/{{$user->username}}/recharge">Recharge</a>
		</li>
		<li class="dropdown-item">
			<a href="/{{$user->username}}/withdrawals">Withdrawals</a>
		</li>
		@if($user->type=="seller")
		<li class="dropdown-item">
			<a href="/{{$user->username}}/sales">Your Sales</a>
		</li>
		<li class="dropdown-item">
			<a href="/{{$user->username}}/services/manage">Manage Services</a>
		</li>
		@endif
		<li class="dropdown-item">
			<a href="/tickets">My Support Tickets</a>
		</li>
	</ul>
	<!-- /DROPDOWN -->
		<a href="/job/add" class="button medium secondary">Post a Job</a>
	<br>
		<form method="POST" action="{{ route('logout') }}">
			@csrf
			<input type="submit" class="button secondary" value="Logout" ></form><br>
	@if($user->type=="buyer")
	<form action="/{{$user->username}}/sell/" method="post">
		@csrf
	<button  class="button medium primary">Become a Seller</button>
	</form>
		<br >
	@endif
	@else
			<div class="user-board">
				<div class="account-actions">
					<a href="/login" class="button primary">Login</a>
					<a href="/register" class="button secondary">Register</a>

				</div>
			</div>
	@endif
</div>
<!-- /SIDE MENU -->

<!-- MAIN MENU -->
<div class="main-menu-wrap">
	<div class="menu-bar">
		<nav>
			<ul class="main-menu">
				


				<!-- MENU ITEM -->
				<li class="menu-item">
					<a href="/view/services">Services</a>
				</li>
				<!-- /MENU ITEM -->
				<!-- MENU ITEM -->
				<li class="menu-item">
					<a href="/jobs">Jobs</a>
				</li>
				<!-- /MENU ITEM -->

				<!-- MENU ITEM -->
				<li class="menu-item">
					<a href="/how">How to shop</a>
				</li>
				<!-- /MENU ITEM -->
				
				@if(Auth::check())
		@if($user->type=="seller")
		<li class="menu-item">
			<a href="/{{$user->username}}/services/manage">Manage Services</a>
		</li>
		<li class="menu-item">
			<a href="/{{$user->username}}/sales">Sales</a>
		</li>
		@endif
	
		<li class="menu-item">
			<a onclick="sshow()" href="#">Help</a>
		</li>
		<!-- /DROPDOWN ITEM -->
		@endif

			</ul>
		</nav>
		<form action="\view\services" class="search-form">
			<input type="text" class="rounded" name="search" id="search" placeholder="Search services here...">
			<input type="image" src="\images\search-icon.png" alt="search-icon">
		</form>
	</div>
</div>
<script src="\js\vendor\jquery-3.1.0.min.js"></script>
<!-- Tweet -->
<!-- xmAlert -->
<script src="\js\vendor\jquery.xmalert.min.js"></script>
<!-- Magnific Popup -->
<script src="\js\vendor\jquery.magnific-popup.min.js"></script>
<!-- Side Menu -->
<script src="\js\side-menu.js"></script>
<!-- User Quickview Dropdown -->
<script src="\js\user-board.js"></script>
<!-- Alerts Generator -->
<script src="\js\alerts-generator.js"></script>
<!-- Footer -->
<script src="\js\footer.js"></script>
@if(Auth::check())
<script>
	var sending=false; var lastId={{$lastId}};
    function sshow(){
        $('#help').show();

    }


    function cclose(){
        $('#help').hide();
    }
    
    function getNot(id){
  
    $.ajax({
    	url: '/ajax/notifications/'+lastId,
    	success:function(res){
    	var obj = JSON.parse(res);
    	var audio = new Audio('/media/msg.wav');
    	obj.forEach(function(a){
    	lastId=a['id'];
    		$('body').xmalert({ 
            x: 'right',
            y: 'bottom',
            xOffset: 30,
            yOffset: 30,
            alertSpacing: 20,
            lifetime: 10000,
            fadeDelay: 0.3,
            template: 'item',
            title: '<span class="bold"><a href='+a['link']+' >'+a['title']+'</a></span>',
            timestamp: '1 secound ago',
            imgSrc: 'images/logo_mobile.png',
            iconClass: 'icon-bell'
        });
        
        $('#not').prepend(`<li style="padding-left: 15px; padding-top: 5px; padding-bottom: 10px; height: auto;" class="dropdown-item">
                            <a href="'+a['link']+'" class="link-to"></a>
                            <!-- SVG PLUS -->
                            <svg class="svg-plus">
                                <use xlink:href="#svg-plus"></use>
                            </svg>
                            <!-- /SVG PLUS -->
                            <div class="dropdown-triangle"></div>

                            <p class="text-header tiny">`+a['title']+`</p>
                            <p class="category tiny primary">`+a['body']+`</p>

                        </li>`);
        coun++;
        $('#notC').text(coun);   
        
        audio.play();
        
    		});
    	setTimeout(getNot(lastId), 1000);
   	
   
    		},
    	error:function(){
    	
    	setTimeout(getNot(lastId), 8000);
    	}	
    	});
    	}
  
    getNot(lastId);
    
</script>
@endif


<script src="\js\user-board.js"></script>