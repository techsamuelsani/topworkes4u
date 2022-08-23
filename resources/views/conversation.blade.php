<?php $me=Auth::User();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="\css\vendor\simple-line-icons.css">
	<link rel="stylesheet" href="\css\vendor\magnific-popup.css">
	<link rel="stylesheet" href="\css\style.css">
	<!-- favicon -->
	<link rel="icon" href="\image\favicon.ico">
	<title>{{$user->name}} | Conversation</title>
</head>
<body>



	<!-- SIDE MENU -->
	@include('dashboard.side')
	<!-- /SIDE MENU -->

    <!-- DASHBOARD BODY -->
    <div class="dashboard-body">
        <!-- DASHBOARD HEADER -->
        @include('dashboard.header')
        <!-- DASHBOARD HEADER -->

        <!-- DASHBOARD CONTENT -->
        <div style="float: top;" class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline inbox buttons two primary">
                <h4>Your Inbox</h4>
            </div>
            <!-- /HEADLINE -->

            <!-- INBOX MESSAGES PREVIEW -->
			<div class="inbox-message-preview">
				<div class="inbox-message-preview-header">
					<p class="text-header">
						{{$user->name}}
						<img src="\images\dashboard\star-filled.png" alt="star-icon">
					</p>
					
				</div>

				<div class="inbox-message-preview-body">
					@foreach($conversation as $message)
					@if($message->receiver_id==$user->id)
					<!-- MESSAGE PREVIEW -->
					<div class="message-preview">
						<figure class="user-avatar">
							<img style="width: 40px; height: 40px;" src="\image\{{$me->picLink}}" alt="user-avatar">
						</figure>
						<p class="text-header">{{$me->name}}</p>
						<p class="timestamp">{{ date('F d, Y \a\t h:i a', strtotime($message->created_at)) }} @if($message->isSeen==1) &nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 8px;">Seen at {{ date('F d, Y \a\t h:i a', strtotime($message->updated_at)) }} @endif </span></p>
						<p>{{$message->body}}</p>
					</div>
					<!-- /MESSAGE PREVIEW -->
					@endif
					@if($message->sender_id==$user->id)
                        <?php $message->isSeen=1; $message->save(); ?>
					<!-- MESSAGE PREVIEW -->
					<div class="message-preview messageSender">
						<figure class="user-avatar">
							<img style="width: 40px; height: 40px;" src="\image\{{$user->picLink}}" alt="user-avatar">
						</figure>
						<p class="text-header">{{$user->name}}</p>
						<p class="timestamp">{{ date('F d, Y \a\t h:i a', strtotime($message->created_at)) }}</p>
						<p>{{$message->body}}</p>
					</div>
					<!-- /MESSAGE PREVIEW -->
					@endif
					@endforeach

				</div>

				<form method="post" action="" class="inbox-reply-form">
					@csrf
					<input type="text" autocomplete="off" autofocus required  id="reply" name="message" placeholder="Write your message here...">
					<button class="button secondary">Send Message</button>
				</form>
			</div>
            <!-- /INBOX MESSAGES PREVIEW -->
        </div>
        <!-- DASHBOARD CONTENT -->
    </div>
    <!-- /DASHBOARD BODY -->

	<div class="shadow-film closed"></div>

<!-- SVG ARROW -->
<svg style="display: none;">	
	<symbol id="svg-arrow" viewbox="0 0 3.923 6.64014" preserveaspectratio="xMinYMin meet">
		<path d="M3.711,2.92L0.994,0.202c-0.215-0.213-0.562-0.213-0.776,0c-0.215,0.215-0.215,0.562,0,0.777l2.329,2.329
			L0.217,5.638c-0.215,0.215-0.214,0.562,0,0.776c0.214,0.214,0.562,0.215,0.776,0l2.717-2.718C3.925,3.482,3.925,3.135,3.711,2.92z"></path>
	</symbol>
</svg>
<!-- /SVG ARROW -->

<!-- SVG PLUS -->
<svg style="display: none;">
	<symbol id="svg-plus" viewbox="0 0 13 13" preserveaspectratio="xMinYMin meet">
		<rect x="5" width="3" height="13"></rect>
		<rect y="5" width="13" height="3"></rect>
	</symbol>
</svg>
<!-- /SVG PLUS -->

<!-- SVG MINUS -->
<svg style="display: none;">
	<symbol id="svg-minus" viewbox="0 0 13 13" preserveaspectratio="xMinYMin meet">
		<rect y="5" width="13" height="3"></rect>
	</symbol>
</svg>
<!-- /SVG MINUS -->

<script src="\js\dashboard-inbox.js"></script>
<script>
	var sending=false;
    var audio = new Audio('/media/msg.wav');
    setInterval(function(){
        if(sending==false){
            sending=true;
			$.ajax({
				url:'/ajax/{{$user->username}}/conversation/new',
				success:function(response){
				if(response!="null") {
                    audio.play();
                    $('.inbox-message-preview-body').append(response);
                    $('.inbox-message-preview-body').scrollTop(9999999999999);
                }
				},
				complete:function(){sending=false;}

			});
        }
    }, 1000);
    $('.inbox-message-preview-body').scrollTop(9999999999999);
</script>
</body>
</html>