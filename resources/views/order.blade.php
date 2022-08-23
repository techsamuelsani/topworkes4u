<?php use Carbon\Carbon; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="\css\vendor\simple-line-icons.css">
	<link rel="stylesheet" href="\css\vendor\tooltipster.css">
	<link rel="stylesheet" href="\css\vendor\magnific-popup.css">
	<link rel="stylesheet" href="\css\style.css">
	<!-- favicon -->
	<link rel="icon" href="\image\favicon.ico">
	<title>Lancerr | Order Page</title>
	<style>
		#count  p { margin-top: 60px !important; font-size: 60px !important;}

		 .upload-btn-wrapper {
			 position: relative;
			 width: 100%;
			 overflow: hidden;
			 display: inline-block;
		 }

		.upbtn {
			border: 2px solid gray;
			color: gray;
			width: 100%;
			background-color: white;
			padding: 8px 20px;
			border-radius: 8px;
			font-size: 20px;
			font-weight: bold;
		}

		.upload-btn-wrapper input[type=file] {
			font-size: 50px;
			position: absolute;
			width: 100%;
			left: 0;
			top: 0;
			opacity: 0;
		}
		.error{
			color: brown;
			font-size: 18px;
		}

	</style>
</head>
<body>

	<!-- HEADER -->
	@include('header')
	<!-- /HEADER -->

	<div id="pop" style="display: none;">
		<div class="mfp-bg mfp-fade mfp-ready"></div>
		<div class="mfp-wrap mfp-close-btn-in mfp-auto-cursor mfp-fade mfp-ready" tabindex="-1" style="overflow-x: hidden; overflow-y: auto;"><div class="mfp-container mfp-s-ready mfp-inline-holder"><div class="mfp-content"><div id="new-message-popup" class="form-popup new-message">
						<!-- FORM POPUP CONTENT -->
						<div class="form-popup-content">
							<h4 class="popup-title">Deliver Order</h4>
							<!-- LINE SEPARATOR -->
							<hr class="line-separator">
							<!-- /LINE SEPARATOR -->
							<form method="post" action="" enctype="multipart/form-data" class="new-message-form">
								@csrf
								<!-- INPUT CONTAINER -->
								<div class="input-container">
									<label class="rl-label required">Upload Main File</label>
									<!-- UPLOAD FILE -->
									<div class="upload-file">
										<div class="">
											<div class="upload-btn-wrapper">
												<button style="margin-top: 0px;" class="upbtn">Select File</button>
												<input type="file" name="file" />
											</div>
										</div>

									</div>
									<!-- UPLOAD FILE -->
								</div>
								<!-- /INPUT CONTAINER -->
								<!-- INPUT CONTAINER -->
								<div class="input-container">
									<label for="message" class="rl-label b-label required">Your Comment:</label>
									<textarea style="height: auto;" id="quote" name="comment" placeholder="Write your quote here..."></textarea>
								</div>
								<!-- INPUT CONTAINER -->

								<button class="button mid dark">Deliver <span class="primary">Now</span></button>
							</form>
						</div>
						<!-- /FORM POPUP CONTENT -->
						<a onclick="cclose()" class="close-btn mfp-close"><span style="color: white; position: absolute; left: 10px;">X</span></a>
					</div></div></div></div>
	</div>


	<!-- SECTION -->
	<div class="section-wrap">
        <?php if($order->type=="offer"){$title=$order->offer->service->title; $price=$order->offer->price; $service=$order->offer->service; $days=$order->offer->days;}
        if($order->type=="package"){$title=$order->package->service->title; $price=$order->package->price; $service=$order->package->service; $days=$order->package->days;}
        $link = preg_replace('/\s+/', '_', $service->title);  ?>
		<div class="section">
			<!-- SIDEBAR -->
			<div class="sidebar right">
				<!-- SIDEBAR ITEM -->
				<div class="sidebar-item author-bio">
					<h4>Buyer</h4>
					<hr class="line-separator">
					<!-- USER AVATAR -->
					<a href="\{{$order->buyer->username}}" class="user-avatar-wrap medium">
						<figure class="user-avatar medium">
							<img style="height: 70px; width: 70px;" src="\image\{{$order->buyer->picLink}}" alt="{{$order->buyer->username}}">
						</figure>
					</a>
					<!-- /USER AVATAR -->
					<p class="text-header">{{$order->buyer->name}}</p>
					<!-- /SHARE LINKS -->
					<a href="/{{$order->buyer->username}}" class="button mid dark spaced">Go to Profile Page</a>
					<a href="/{{$order->buyer->username}}/conversation" class="button mid dark-light">Send a Private Message</a>
				</div>
				<!-- /SIDEBAR ITEM -->

				<!-- SIDEBAR ITEM -->
				<div class="sidebar-item product-info">
					<h4>Service Information</h4>
					<hr class="line-separator">
					<!-- INFORMATION LAYOUT -->
					<div class="information-layout">
						<!-- INFORMATION LAYOUT ITEM -->
						<div class="information-layout-item">
							<p class="text-header">Sales:</p>
							<p>{{count($service->orders())}}</p>
						</div>
						<!-- /INFORMATION LAYOUT ITEM -->

						<!-- INFORMATION LAYOUT ITEM -->
						<div class="information-layout-item">
							<p class="text-header">Upload Date:</p>
							<p>{{ date('F d, Y', strtotime($service->created_at)) }}</p>
						</div>
						<!-- /INFORMATION LAYOUT ITEM -->

						<!-- INFORMATION LAYOUT ITEM -->
						<div class="information-layout-item">
							<p class="text-header">Category:</p>
							<p>{{$service->category->name}}</p>
						</div>
						<!-- /INFORMATION LAYOUT ITEM -->


						<!-- /INFORMATION LAYOUT ITEM -->

						<!-- INFORMATION LAYOUT ITEM -->
						<div class="information-layout-item">
							<p class="tags primary"> @foreach($service->tags as $tag) <a href="\view\services\?search={{$tag->tag}}">{{$tag->tag}}</a>,@endforeach </p>
						</div>
						<!-- /INFORMATION LAYOUT ITEM -->
					</div>
					<!-- INFORMATION LAYOUT -->
				</div>
				<!-- /SIDEBAR ITEM -->
			</div>
			<!-- /SIDEBAR -->

			<!-- CONTENT -->
			<div class="content left">
				<!-- POST -->
				<article class="post">
						<?php $datenow=Carbon::now(); $datenow=$datenow->subDays($days); ?>
					<div  class="sidebar-item">
						<h2 style="color: black;">Order Status</h2>
						<br/>
						<hr class="line-separator">
						@if($order->status=="0")
							<form action="{{$order->id}}/action" method="post">
								@csrf
								<input type="submit" name="accept" value="Accept Order"  style="width: 100%; cursor: pointer;" class="button primary big" />
								<br/>
								<input type="submit" name="cancel" value="Cancel Order"  style="width: 100%; cursor: pointer;" class="button secondary big" />
							</form>
						@elseif($order->status=="canceled")
							<center><h1 style="color: RED; font-size: 80px;">CANCELED</h1></center>
						@elseif($order->status=="delivered")
							<center><h1 style="color: greenyellow; font-size: 80px;">DELIVERED</h1></center>
						@elseif($order->status=="completed")
							<center><h1 style="color: forestgreen; font-size: 80px;">COMPLETED</h1></center>
						@elseif($datenow > $order->created_at)
								<center><h1 style="color: firebrick; font-size: 80px;">YOU ARE LATE</h1></center>
						@else
						<div style="align-items: center;" id="count" class="bid-countdown">


						</div>
						@endif
						<div class="clearfix"></div>
					</div>
					<hr class="line-separator">

					<!-- POST CONTENT -->
					<div class="post-content">
						<!-- POST PARAGRAPH -->
						<div class="post-paragraph">

							<h2 style="color:black;" class="post-title">Order for: <a href="\{{$service->user->username}}\{{$link}}\{{$service->id}}">{{$title}}</a> &nbsp;&nbsp;<span style="float: right;">Amount:<span style="color: #00d7a3;">${{$price}}</span></span></h2>
							<hr class="line-separator">
							<br />
							<h3 class="post-title small">Objective:</h3>
							<p style="padding-left:40px;">@if($order->offer){{$order->offer->job->requirements}}<br />
								<strong style="color: black;">You Offered:</strong>{{$order->offer->quote}}
								@endif
								@if($order->package){{$order->package->detail}}@endif</p>
						</div>
						<!-- /POST PARAGRAPH -->

						<!-- POST PARAGRAPH -->
						<div class="post-paragraph">
							<h3 class="post-title small">Serive Details:</h3>
							<p style="padding-left:40px;">{{$service->details}}</p>
						</div>
						<!-- /POST PARAGRAPH -->
						<br /><br />
						@if($order->status != "canceled" && $order->status != "0" && $order->status != "completed")
                        @if(count($order->deliveries))
                            <button onclick="sshow()" style="width: 100%;" class="button dark big">Deliver Again</button>
                        @else
						    <button onclick="sshow()" style="width: 100%;" class="button dark big">Deliver Now</button>
                        @endif
						@endif

						@if($order->review)
							<br />
							<br />
							<!-- /POST PARAGRAPH -->
							<div style="box-shadow: 0px 0px 10px #1e2527; padding: 20px; max-width: 500px; margin: auto;" class="post-paragraph">
								<label style="margin-bottom: 0px;" class="post-title small">Review Given:</label>
								<hr class="line-separator">
								<br />
								<div style="margin: auto; max-width: 500px; padding-left: 20px;"  method="post" action="{{$order->id}}\review">
									@foreach($order->review->ratings as $rating)
                                        <?php $skill=$rating->skill;
                                        $name = preg_replace('/\s+/', '_', $skill->name); ?>
										<div class="clearfix"></div>
										<div style="max-width: 500px;">
											<label style="font-size: 20px; color: #2b373a;" style="color: black; font-size: 30px;">{{$skill->name}}:</label>
											<ul style="margin-left:50px; " class="rating tooltip tooltipstered">

												<li class="rating-item  @if(($rating->rating/1) < 1) empty @endif">
													<!-- SVG STAR -->
													<svg style="height: 20px; width: 20px;" class="svg-star">
														<use xlink:href="#svg-star"></use>
													</svg>
													<!-- /SVG STAR -->
												</li>
												<li  class="rating-item  @if(($rating->rating/1) < 2) empty @endif">
													<!-- SVG STAR -->
													<svg style="height: 20px; width: 20px;" class="svg-star">
														<use xlink:href="#svg-star"></use>
													</svg>
													<!-- /SVG STAR -->
												</li>
												<li class="rating-item  @if(($rating->rating/1) < 3) empty @endif">
													<!-- SVG STAR -->
													<svg style="height: 20px; width: 20px;" class="svg-star">
														<use xlink:href="#svg-star"></use>
													</svg>
													<!-- /SVG STAR -->
												</li>
												<li  class="rating-item  @if(($rating->rating/1) < 4) empty @endif">
													<!-- SVG STAR -->
													<svg style="height: 20px; width: 20px;" class="svg-star">
														<use xlink:href="#svg-star"></use>
													</svg>
													<!-- /SVG STAR -->
												</li>
												<li  class="rating-item  @if(($rating->rating/1) < 5) empty @endif">
													<!-- SVG STAR -->
													<svg style="height: 20px; width: 20px;" class="svg-star">
														<use xlink:href="#svg-star"></use>
													</svg>
													<!-- /SVG STAR -->
												</li>
											</ul>
											<div class="clearfix"></div>
										</div>
									@endforeach
										<hr class="line-separator">
										<br />
									    <span style="color: #0b0b0b; font-size: 20px;">Review:</span><label style="padding-left: 20px;">{{$order->review->comment}}</label>
									<br />
								</div>
							</div>
						@endif
					</div>
					<!-- /POST CONTENT -->
				</article>
				<!-- /POST -->
			@if($order->status != "Canceled")
				<!-- POST TAB -->
				<div class="post-tab">
					<!-- TAB HEADER -->
					<div class="tab-header tertiary">
						<!-- TAB ITEM -->
						<div style="width: 50% !important;" class="tab-item selected">
							<p class="text-header">Messages</p>
						</div>
						<!-- /TAB ITEM -->

						<!-- TAB ITEM -->
						<div style="width: 50% !important;" class="tab-item">
							<p class="text-header">Deliveries</p>
						</div>
						<!-- /TAB ITEM -->

					</div>
					<!-- /TAB HEADER -->

					<!-- TAB CONTENT -->
					<div class="tab-content void">
						<!-- COMMENTS -->
						<div style="max-height: 500px; overflow-y: auto;"  class="comment-list">
							@foreach($messages as $message)
							<!-- COMMENT -->
							<div class="comment-wrap">
								<!-- USER AVATAR -->
								<a href="\{{$message->sender->username}}">
									<figure class="user-avatar medium">
										<img style="width: 70px;height: 70px;" src="\image\{{$message->sender->picLink}}" alt="">
									</figure>
								</a>
								<!-- /USER AVATAR -->
								<div class="comment">
									<p class="text-header">{{$message->sender->name}}</p>
									<p class="timestamp">{{ date('F d, Y \a\t h:i a', strtotime($message->created_at)) }}</p>
									<p>{{$message->body}}</p>
								</div>
							</div>
							<!-- /COMMENT -->

							<!-- LINE SEPARATOR -->
							<hr class="line-separator">
							<!-- /LINE SEPARATOR -->
							@endforeach


						</div>
						<!-- /COMMENTS -->
						<div  class="comment-list">
						<br />
						<span style="font-size: 26px; font:bold;">Leave a Message</span>
						<br />

						<!-- COMMENT REPLY -->
						<div class="comment-wrap comment-reply">
							<!-- USER AVATAR -->
							<a href="\{{$order->seller()->username}}">
								<figure class="user-avatar medium">
									<img style="height: 70px; width: 70px;" src="\image\{{$order->seller()->picLink}}" alt="">
								</figure>
							</a>
							<!-- /USER AVATAR -->

							<!-- COMMENT REPLY FORM -->
							<form method="post" action="{{$order->id}}/message" class="comment-reply-form">
								@csrf
								<input type="hidden" name="reference" value="o{{$order->id}}">
								<textarea required name="body" placeholder="Write your message here..."></textarea>
								<input type="file" name="file" />
								<button class="button tertiary">Send Message</button>
							</form>
							<!-- /COMMENT REPLY FORM -->
						</div>
						</div>
					</div>
					<!-- /TAB CONTENT -->

					<!-- TAB CONTENT -->
					<div  class="tab-content void">
						<!-- COMMENTS -->
						<div style="max-height: 500px; overflow-y: auto;" class="comment-list">
							@foreach($order->deliveries as $delivery)
							<!-- COMMENT -->
							<div class="comment-wrap">
								<!-- USER AVATAR -->
								<a href="\{{$order->seller()->username}}">
									<figure class="user-avatar medium">
										<img src="\image\{{$order->seller()->picLink}}" alt="{{$order->seller()->name}}">
									</figure>
								</a>
								<!-- /USER AVATAR -->
								<div class="comment">
									<p class="text-header">{{$order->seller()->name}}</p>
									<p class="timestamp">{{ date('F d, Y \a\t h:i a', strtotime($delivery->created_at)) }}</p>
									@if($delivery->fileLink)
									<a href="\file\{{$delivery->id}}" style="font-size: 30px; color: #03f1b6;" class="report">Download</a>
									@endif
									<p>{{$delivery->comment}}</p>
								</div>
							</div>
							<!-- /COMMENT -->

							<!-- LINE SEPARATOR -->
							<hr class="line-separator">
							<!-- /LINE SEPARATOR -->
							@endforeach
						</div>
						<!-- /COMMENTS -->
					</div>
					<!-- /TAB CONTENT -->
				</div>
				<!-- /POST TAB -->
			@endif
			</div>
			<!-- CONTENT -->
		</div>
	</div>
	<!-- /SECTION -->

	<!-- FOOTER -->
	@include('footer')
	<!-- /FOOTER -->

	<div class="shadow-film closed"></div>

<!-- SVG ARROW -->
<svg style="display: none;">	
	<symbol id="svg-arrow" viewbox="0 0 3.923 6.64014" preserveaspectratio="xMinYMin meet">
		<path d="M3.711,2.92L0.994,0.202c-0.215-0.213-0.562-0.213-0.776,0c-0.215,0.215-0.215,0.562,0,0.777l2.329,2.329
			L0.217,5.638c-0.215,0.215-0.214,0.562,0,0.776c0.214,0.214,0.562,0.215,0.776,0l2.717-2.718C3.925,3.482,3.925,3.135,3.711,2.92z"></path>
	</symbol>
</svg>
<!-- /SVG ARROW -->

<!-- SVG STAR -->
<svg style="display: none;">
	<symbol id="svg-star" viewbox="0 0 10 10" preserveaspectratio="xMinYMin meet">	
		<polygon points="4.994,0.249 6.538,3.376 9.99,3.878 7.492,6.313 8.082,9.751 4.994,8.129 1.907,9.751 
	2.495,6.313 -0.002,3.878 3.45,3.376 "></polygon>
	</symbol>
</svg>
<!-- /SVG STAR -->

<!-- SVG PLUS -->
<svg style="display: none;">
	<symbol id="svg-plus" viewbox="0 0 13 13" preserveaspectratio="xMinYMin meet">
		<rect x="5" width="3" height="13"></rect>
		<rect y="5" width="13" height="3"></rect>
	</symbol>
</svg>
<!-- /SVG PLUS -->

<!-- SVG CHECK -->
<svg style="display: none;">
	<symbol id="svg-check" viewbox="0 0 15 12" preserveaspectratio="xMinYMin meet">
		<polygon points="12.45,0.344 5.39,7.404 2.562,4.575 0.429,6.708 3.257,9.536 3.257,9.536 
			5.379,11.657 14.571,2.465 "></polygon>
	</symbol>
</svg>
<!-- /SVG CHECK -->

<!-- jQuery -->

<!-- ImgLiquid -->
<script src="\js\vendor\imgLiquid-min.js"></script>
<!-- XM Tab -->
<script src="\js\vendor\jquery.xmtab.min.js"></script>
<!-- Tweet -->
<!-- Side Menu -->

<!-- Liquid -->
<script src="\js\liquid.js"></script>
<!-- Magnific Popup -->
<script src="\js\vendor\jquery.magnific-popup.min.js"></script>
<!-- Post Tab -->
<script src="\js\post-tab.js"></script>
<!-- XM Accordion -->
<script src="\js\vendor\jquery.xmaccordion.min.js"></script>
<!-- XM Pie Chart -->
<script src="\js\vendor\jquery.xmpiechart.min.js"></script>
<!-- XM Countdown -->
<script src="\js\vendor\jquery.xmcountdown.min.js"></script>
<!-- Auction Page -->
<script src="\js\auction-page.js"></script>
<!-- Tooltip -->
<script src="\js\tooltip.js"></script>

	<?php
    $date=$order->created_at;
    $days=30;
    if($order->type=="offer"){
        $days=$days-(($order->offer->days)/1);
	}elseif($order->type=="package"){
        $days=$days-(($order->package->days)/1);
    }
    $date=$date->subDays($days);
	?>
<script>
    $('.bid-countdown').xmcountdown({
        width: 190,
        height: 190,
        fillWidth: 15,
        gradient: true,
        gradientColors: ['#eff0f4','#eff0f4'],
        targetDate: new Date({{ date('Y,m,d,H,i,s', strtotime($date)) }} ),
        daysText: "Days",
        hoursText: "Hours",
        minutesText: "Mins",
        secondsText: "Secs",
        outline: true
    });
</script>

	<script>
        function sshow(){
            $('#pop').show();
        }

        function cclose(){
            $('#pop').hide();
        }
	</script>
</body>
</html>