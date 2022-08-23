<?php
$user=Auth::user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="\css\vendor\simple-line-icons.css">
	<link rel="stylesheet" href="\css\vendor\tooltipster.css">
	<link rel="stylesheet" href="\css\style.css">
	<!-- favicon -->
	<link rel="icon" href="\image\favicon.ico">
	<title>Lancerr.net | Dashboard</title>
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
			<div class="headline purchases primary">
				<h4>Your Ticket</h4>

			</div>
			<!-- /HEADLINE -->
			<div class="content left">
				<!-- THREAD -->
				<div class="thread">
					<!-- THREAD TITLE -->
					<div class="thread-title pinned">
						<span class="pin primary">@if($ticket->status==0) Opened @else Closed @endif</span>
						<p class="text-header">{{$ticket->title}}</p>
					</div>
					<!-- /THREAD TITLE -->

					<!-- COMMENTS -->
					<div class="comment-list">
						<!-- COMMENT -->
						<div class="comment-wrap">
							<!-- USER AVATAR -->
							<a href="/{{$ticket->user->username}}">
								<figure class="user-avatar medium">
									<img style="height: 60px; width: 60px;" src="\image\{{$ticket->user->picLink}}" alt="">
								</figure>
							</a>
							<!-- /USER AVATAR -->
							<div class="comment">
								<p class="text-header"><a href="/{{$ticket->user->username}}">{{$ticket->user->name}}</a></p>
								<p class="timestamp">{{ date('F d, Y \a\t h:i a', strtotime($ticket->created_at)) }}</p>
								<p>{{$ticket->details}}<br>
									@if($ticket->fileLink)
										<a href="\file\{{$ticket->id}}\{{$ticket->fileLink}}" style="font-size: 20px; color: #03f1b6;" class="report">Download File</a>
									@endif</p>
							</div>
						</div>
						<!-- /COMMENT -->
						<!-- LINE SEPARATOR -->
						<hr class="line-separator">
						<!-- /LINE SEPARATOR -->
						@foreach($ticket->replies as $reply)
							<!-- COMMENT -->
								<div class="comment-wrap">
									<!-- USER AVATAR -->
									<a>
										<figure class="user-avatar medium">
											<img style="height: 60px; width: 60px;" src="\image\{{$reply->user->picLink}}" alt="">
										</figure>
									</a>
									<!-- /USER AVATAR -->
									<div class="comment">
										<p class="text-header">{{$reply->user->name}}</p>
										<p class="timestamp">{{ date('F d, Y \a\t h:i a', strtotime($reply->created_at)) }}</p>
										<p>{{$reply->reply}}<br>
											@if($reply->fileLink)
												<a href="\file\{{$ticket->id}}\{{$reply->fileLink}}" style="font-size: 20px; color: #03f1b6;" class="report">Download File</a>
											@endif
										</p>
									</div>
								</div>
								<!-- /COMMENT -->
								<!-- LINE SEPARATOR -->
								<hr class="line-separator">
								<!-- /LINE SEPARATOR -->
						@endforeach



						<div class="clearfix"></div>

						<!-- LINE SEPARATOR -->
						<hr class="line-separator">
						<!-- /LINE SEPARATOR -->

						<h3>Leave a Reply</h3>

						<!-- COMMENT REPLY -->
						<div style="padding-left: 30px;" class="comment-wrap comment-reply">


							<!-- COMMENT REPLY FORM -->
							<form method="post" action="" enctype="multipart/form-data" class="comment-reply-form">
								@csrf
								<textarea name="reply" placeholder="Write your reply here..."></textarea>
								<input type="file" name="file">
								<button class="button primary">Send Reply</button>
							</form>
							<!-- /COMMENT REPLY FORM -->
						</div>
						<!-- /COMMENT REPLY -->
					</div>
					<!-- /COMMENTS -->
				</div>
				<!-- /THREAD -->
			</div>
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

<!-- SVG STAR -->
<svg style="display: none;">
	<symbol id="svg-star" viewbox="0 0 10 10" preserveaspectratio="xMinYMin meet">	
		<polygon points="4.994,0.249 6.538,3.376 9.99,3.878 7.492,6.313 8.082,9.751 4.994,8.129 1.907,9.751 
	2.495,6.313 -0.002,3.878 3.45,3.376 "></polygon>
	</symbol>
</svg>
<!-- /SVG STAR -->

<!-- jQuery -->
<script src="\js\vendor\jquery-3.1.0.min.js"></script>
<!-- Tooltipster -->
<script src="\js\vendor\jquery.tooltipster.min.js"></script>
<!-- XM Pie Chart -->
<script src="\js\vendor\jquery.xmpiechart.min.js"></script>
<!-- Side Menu -->
<script src="\js\side-menu.js"></script>
<!-- Dashboard Header -->
<script src="\js\dashboard-header.js"></script>
<!-- Tooltip -->
<script src="\js\tooltip.js"></script>
<!-- Dashboard ManageItems -->
<script src="\js\dashboard-manageitems.js"></script>
</body>
</html>