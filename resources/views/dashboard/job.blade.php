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
	<script src="https://www.2checkout.com/static/checkout/javascript/direct.min.js"></script>
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
            <div class="headline filter primary">
                <h4>Manage</h4>
            </div>
            <!-- /HEADLINE -->
			<div class="product-list grid column1-wrap">

				<!-- PRODUCT ITEM -->
				<div style="padding: 10px !important;" class="product-item column">

					<!-- PRODUCT INFO -->
					<div class="product-info">
						<a href="/job/view/{{$job->id}}">
							<p class="text-header">{{$job->title}}</p>
						</a>
						<p style="height: 32px; overflow:hidden;" class="product-description">{{$job->details}}</p>
						<a href="shop-gridview-v1.html">
							<p class="category primary">{{$job->category->name}}</p>
						</a>
						<p class="price"><span>$</span>{{$job->budget}}</p>
					</div>
					<hr class="line-separator">
					<div style="float: right;">
						<a style="display: inline-block;" href="{{$job->id}}/remove" class="button medium primary">Remove</a>
						@if($job->isActive==1)
						<a style="display: inline-block;" href="{{$job->id}}/deactivate" class="button medium secondary">Deactivate</a>
						@endif
					</div>
					<br /><br /><br />
					<!-- /PRODUCT INFO -->
					<hr class="line-separator">

					<!-- USER RATING -->
					<div class="user-rating">
						<a href="author-profile.html">
							<figure class="user-avatar small">
								<img style="height: 26px; width: 26px;" src="\image\{{$user->picLink}}" alt="user-avatar">
							</figure>
						</a>
						<a href="author-profile.html">
							<p class="text-header tiny">{{$user->name}}</p>
						</a>
					</div>
					<!-- /USER RATING -->
				</div>
				<!-- /PRODUCT ITEM -->

			</div>
			<div class="product-showcase">
				@foreach($job->offers as $offer)
                    <?php $link = preg_replace('/\s+/', '_', $offer->service->title); ?>
				<!-- PRODUCT LIST -->
				<div style="margin: 0px !important; width: 100% !important;" class="product-list list">
					<!-- PRODUCT ITEM -->
					<div  class="product-item">
						<a href="/{{$offer->user->username}}/{{$link}}/{{$offer->service->id}}">
							<!-- PRODUCT PREVIEW IMAGE -->
							<figure class="product-preview-image small">
								<img src="\image\{{$offer->service->imgLink}}" alt="product-image">
							</figure>
							<!-- /PRODUCT PREVIEW IMAGE -->
						</a>

						<!-- PRODUCT INFO -->
						<div style="width: 44% !important; height: auto;" class="product-info">
							<a href="/{{$offer->user->username}}/{{$link}}/{{$offer->service->id}}">
								<p class="text-header">{{$offer->service->title}}</p>
							</a>
							<p class="product-description">{{$offer->quote}}</p>
							<p class="product-description"><strong>In {{$offer->days}} days</strong></p>
							<a href="shop-gridview-v1.html">
								<p class="category primary">{{$offer->service->category->name}}</p>
							</a>
						</div>
						<!-- /PRODUCT INFO -->

						<!-- AUTHOR DATA -->
						<div class="author-data">
							<!-- USER RATING -->
							<div class="user-rating">
								<a href="/{{$offer->user->username}}">
									<figure class="user-avatar small">
										<img style="height: 26px; width: 26px;" src="\image\{{$offer->user->picLink}}" alt="user-avatar">
									</figure>
								</a>
								<a href="/{{$offer->user->username}}">
									<p class="text-header tiny">{{$offer->user->name}}</p>
								</a>
							</div>
							<!-- /USER RATING -->

							<!-- METADATA -->
							<div class="metadata">
								<!-- META ITEM -->
								<div class="meta-item">
									<span class="icon-bubble"></span>
									<p>12</p>
								</div>
								<!-- /META ITEM -->



							</div>
							<!-- /METADATA -->
						</div>
						<!-- /AUTHOR DATA -->

						<!-- AUTHOR DATA REPUTATION -->
						<div class="author-data-reputation">
							<p class="text-header tiny">Reputation</p>
							<ul class="rating" title="User's Rating">
                                <?php $averageRating=$offer->user->averageRating(); ?>
								<li class="rating-item @if($averageRating < 0.5 ) empty @endif">
									<!-- SVG STAR -->
									<svg class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
								<li class="rating-item @if($averageRating < 1.5 ) empty @endif">
									<!-- SVG STAR -->
									<svg class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
								<li class="rating-item @if($averageRating < 2.5 ) empty @endif">
									<!-- SVG STAR -->
									<svg class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
								<li class="rating-item @if($averageRating < 3.5 ) empty @endif">
									<!-- SVG STAR -->
									<svg class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
								<li class="rating-item @if($averageRating < 4.5 ) empty @endif">
									<!-- SVG STAR -->
									<svg class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
							</ul>
						</div>
						<!-- /AUTHOR DATA REPUTATION -->

						<!-- ITEM ACTIONS -->
						<div title="Buy with card" class="item-actions">
							<form action='https://sandbox.2checkout.com/checkout/purchase' method='post'>
								<input type='hidden' name='sid' value='901394469' />
								<input type='hidden' name='mode' value='2CO' />
								<input type='hidden' name='li_0_type' value='product' />
								<input type='hidden' id="idd"  name='li_0_name' value='o{{$offer->id}}' />
								<input type='hidden' id="pprice" name='li_0_price' value='{{$offer->price}}' />
								<input type='hidden' name='card_holder_name' value='{{$user->name}}' />
								<input type='hidden' name='street_address' value='{{$user->address}}' />
								<input type='hidden' name='city' value='{{$user->city}}' />
								<input type='hidden' name='state' value='{{$user->state}}' />
								<input type='hidden' name='zip' value='{{$user->zip}}' />
								<input type='hidden' name='country' value='{{$user->country}}' />
								<input type='hidden' name='email' value='{{$user->email}}' />
								<input type='hidden' name='phone' value='{{$user->phone}}' />
								<button style="background: none;" title="Buy with card" class="tooltip tooltipstered">
									<div style="background-color:#1cbdf9;" class="circle tiny">
										<span style="font-size: 25px; position: absolute; top: 8px; left: 8px;" class="icon-basket"></span>
									</div>
								</button>
							</form>

						</div>
						@if($user->balance>=$offer->price)
						<div class="item-actions">
							<form action='\offer\{{$offer->id}}\buy' method='post'>
								@csrf
								<input type='hidden' id="idd"  name='li_0_name' value='o{{$offer->id}}' />
								<button style="background: none;" title="Buy with balance" class="tooltip tooltipstered">
									<div style="background-color:#03f1b6;" class="circle tiny">
										<span style="font-size: 25px; position: absolute; top: 8px; left: 8px;" class="icon-basket"></span>
									</div>
								</button>
							</form>

						</div>
						@endif
						<!-- /ITEM ACTIONS -->

						<!-- PRICE INFO -->
						<div style="float: right;" class="price-info">
							<p class="price medium"><span>$</span>{{$offer->price}}</p>
						</div>
						<!-- /PRICE INFO -->
					</div>
					<!-- /PRODUCT ITEM -->

				</div>
				<!-- /PRODUCT LIST -->
				@endforeach
				<div class="clearfix"></div>
			</div>

			<div class="clearfix"></div>
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
<script>
    var myCallback = function(data) {
        console.log(JSON.stringify(data));
        // Example callback data
        // {"event_type":"checkout_loaded"}
        // {"event_type":"checkout_closed"}
    };
    (function() {
        inline_2Checkout.subscribe('checkout_loaded', myCallback);
        inline_2Checkout.subscribe('checkout_closed', myCallback);
    }());


</script>
</body>
</html>