<?php $me=Auth::User() ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="\css\vendor\simple-line-icons.css">
	<link rel="stylesheet" href="\css\vendor\magnific-popup.css">
	<link rel="stylesheet" href="\css\style.css">
	<!-- favicon -->
	<link rel="icon" href="\image\favicon.ico">
	<title>Lancerr | Inbox</title>
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
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline buttons two primary">
                <h4>Your Inbox ({{count($ids)-1}})</h4>
            </div>
            <!-- /HEADLINE -->

			<!-- INBOX MESSAGES -->
			<div class="inbox-messages">
			 <?php	foreach($ids as $id){
                if($me->id!=$id){
				 $user=App\User::find($id);
                    $message=App\Message::where([
                        ['sender_id',$me->id],
                        ['receiver_id',$user->id],
                    ])->orWhere([
                        ['sender_id',$user->id],
                        ['receiver_id',$me->id],
                    ])->orderBy('created_at', 'desc')->first();
                    if($message->sender_id==$me->id){
                    ?>
					<!-- INBOX MESSAGE -->
					<div class="inbox-message">
						<div class="inbox-message-actions">
							<!-- CHECKBOX -->
							<input type="checkbox" id="msg1" name="msg1">
							<label for="msg1" class="label-check">
								<span class="checkbox primary"><span></span></span>
							</label>
							<!-- /CHECKBOX -->

						</div>

						<div class="inbox-message-author">
							<figure class="user-avatar">
								<img style="height: 40px; width: 40px;" src="\image\{{$user->picLink}}" alt="user-img">
							</figure>
							<p class="text-header">
								{{$user->name}} &nbsp;&nbsp;
								<span style="font-size: 16px" class="icon-speech secondary"></span>
							</p>
						</div>

						<a href="/{{$user->username}}/conversation">
							<div class="inbox-message-content">
								<p class="description">{{$message->body}}</p>
							</div>
						</a>


						<div class="inbox-message-date">
							<p>{{ date('F d, Y \a\t h:i a', strtotime($message->created_at)) }}</p>
						</div>
					</div>
					<!-- INBOX MESSAGE -->
				    <?php } elseif($message->receiver_id==$me->id){  ?>


					<!-- INBOX MESSAGE -->
					<div class="inbox-message">
						<div class="inbox-message-actions">
							<!-- CHECKBOX -->
							<input type="checkbox" id="msg1" name="msg1">
							<label for="msg1" class="label-check">
								<span class="checkbox primary"><span></span></span>
							</label>
							<!-- /CHECKBOX -->
						</div>

						<div class="inbox-message-author">
							<figure class="user-avatar">
								<img style="width:40px; height: 40px; " src="\image\{{$user->picLink}}" alt="user-img">
							</figure>
							<p  class="text-header">
								{{$user->name}} &nbsp;&nbsp;
								@if($message->isSeen==1)
								<span style="font-size: 16px;" class="icon-envelope-open secondary"></span>
								@else
								<span style="font-size: 18px;" class="icon-envelope primary"></span>
								@endif
							</p>
						</div>

						<a href="/{{$user->username}}/conversation">
							<div class="inbox-message-content">
								<p @if($message->isSeen!=1) style="color: #2b373a;" @endif class="description">{{$message->body}}</p>
							</div>
						</a>


						<div class="inbox-message-date">
							<p>{{ date('F d, Y \a\t h:i a', strtotime($message->created_at)) }}</p>
						</div>
					</div>
					<!-- INBOX MESSAGE -->

				<?php
                }}}?>

			</div>
			<!-- /INBOX MESSAGES -->
        </div>
        <!-- DASHBOARD CONTENT -->
    </div>
    <!-- /DASHBOARD BODY -->





<!-- Dashboard Inbox -->
<script src="\js\dashboard-inbox.js"></script>
<!-- Inbox Messages -->
<script src="\js\inbox-messages.js"></script>
</body>
</html>