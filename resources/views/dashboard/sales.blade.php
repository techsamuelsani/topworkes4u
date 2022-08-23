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
				<h4>Your Sales</h4>

			</div>
			<!-- /HEADLINE -->

			<!-- PURCHASES LIST -->
			<div class="purchases-list">
				<!-- PURCHASES LIST HEADER -->
				<div class="purchases-list-header">
					<div class="purchases-list-header-date">
						<p class="text-header small">Date</p>
					</div>
					<div class="purchases-list-header-details">
						<p class="text-header small">Product Details</p>
					</div>
					<div class="purchases-list-header-info">
						<p class="text-header small">Additional Info</p>
					</div>
					<div class="purchases-list-header-price">
						<p class="text-header small">Price</p>
					</div>
					<div class="purchases-list-header-download">
						<p class="text-header small">Download</p>
					</div>
					<div class="purchases-list-header-recommend">
						<p class="text-header small">Review</p>
					</div>
				</div>
				<!-- /PURCHASES LIST HEADER -->

			@foreach($user->sellings() as $order)
				<!-- PURCHASE ITEM -->
					<div class="purchase-item">
						<div class="purchase-item-date">
							<p>{{ date('F d, Y', strtotime($order->created_at)) }}</p>
						</div>
						<div  class="purchase-item-details">
							<!-- ITEM PREVIEW -->
							<div class="item-preview">
								<figure class="product-preview-image small liquid imgLiquid_bgSize imgLiquid_ready">
									<img style="width: 70px; height: 70px;" src="\image\{{$order->service()->imgLink}}" alt="product-image" >
								</figure>
								<a href="#" class="text-header">{{$order->service()->title}}</a>
								<p style="height: 40px; overflow: hidden; line-height: 12px; font-size: 10px;" class="">{{$order->service()->details}}</p>
							</div>
							<!-- /ITEM PREVIEW -->
						</div>
						<div class="purchase-item-info">
							<p class="category primary">{{$order->service()->category->name}}</p>
							<p>Status:@if($order->status=="completed") Completed @elseif($order->status=="delivered") Delivered @elseif($order->status=="canceled") Canceled @else Waiting @endif </p>
							<p><span class="light">Buyer:</span> <a style="color: #0fccf4;" href="\{{$order->buyer->username}}">{{$order->buyer->name}}</a></p>
						</div>
						<div class="purchase-item-price">
							<p class="price"><span>$</span>{{$order->payment->total}}</p>
						</div>
						<div class="purchase-item-download">
							<a href="\{{$user->username}}\selling\{{$order->id}}" class="button dark-light">Goto Order</a>
						</div>
						<div class="purchase-item-recommend">
							@if($order->review)
								<ul style="width: 100px; margin: auto;" class="report rating tooltip tooltipstered">
									<li class="rating-item @if($order->review->ratingAverage() < 0.5) empty @endif">
										<!-- SVG STAR -->
										<svg style="height: 15px; width: 15px;" class="svg-star">
											<use xlink:href="#svg-star"></use>
										</svg>
										<!-- /SVG STAR -->
									</li>
									<li class="rating-item @if($order->review->ratingAverage() < 1.5) empty @endif">
										<!-- SVG STAR -->
										<svg style="height: 15px; width: 15px;" class="svg-star">
											<use xlink:href="#svg-star"></use>
										</svg>
										<!-- /SVG STAR -->
									</li>
									<li class="rating-item @if($order->review->ratingAverage() < 2.5) empty @endif">
										<!-- SVG STAR -->
										<svg style="height: 15px; width: 15px;" class="svg-star">
											<use xlink:href="#svg-star"></use>
										</svg>
										<!-- /SVG STAR -->
									</li>
									<li class="rating-item @if($order->review->ratingAverage() < 3.5) empty @endif">
										<!-- SVG STAR -->
										<svg style="height: 15px; width: 15px;" class="svg-star">
											<use xlink:href="#svg-star"></use>
										</svg>
										<!-- /SVG STAR -->
									</li>
									<li class="rating-item @if($order->review->ratingAverage() < 4.5) empty @endif">
										<!-- SVG STAR -->
										<svg style="height: 15px; width: 15px;" class="svg-star">
											<use xlink:href="#svg-star"></use>
										</svg>
										<!-- /SVG STAR -->
									</li>
									<div class="clearfix"></div>
									<center><span>{{$order->review->ratingAverage()}}</span></center>
								</ul>
							@else
							<span>Not rated yet</span>
							@endif
						</div>
					</div>
					<!-- /PURCHASE ITEM -->
				@endforeach
			</div>
			<!-- /PURCHASES LIST -->
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