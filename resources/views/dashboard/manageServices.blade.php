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
            <div class="headline filter primary">
                <h4>Manage Services ({{count($services)}})</h4>
            </div>
            <!-- /HEADLINE -->

			<!-- PRODUCT LIST -->

			<div class="product-list grid column4-wrap">
				<!-- PRODUCT ITEM -->
				<a href="/{{$user->username}}/service/add">
				<div class="product-item upload-new column">
					<!-- PRODUCT PREVIEW ACTIONS -->
					<div class="product-preview-actions">
						<!-- PRODUCT PREVIEW IMAGE -->
						<figure class="product-preview-image">
							<img src="\images\dashboard\uploadnew-bg.jpg" alt="product-image">
						</figure>
						<!-- /PRODUCT PREVIEW IMAGE -->
					</div>
					<!-- /PRODUCT PREVIEW ACTIONS -->

					<!-- PRODUCT INFO -->
					<div class="product-info">
						<p class="text-header">Upload New Service</p>
						<p class="description">Upload a service in which you are good at.</p>
					</div>
					<!-- /PRODUCT INFO -->
				</div>
				</a>

				<!-- /PRODUCT ITEM -->
				@foreach($services as $service)
				<!-- PRODUCT ITEM -->
				<div class="product-item column">
					<!-- PRODUCT PREVIEW ACTIONS -->
					<div class="product-preview-actions">
						<!-- PRODUCT PREVIEW IMAGE -->
						<figure class="product-preview-image">
							<img style="height: 150px !important;" src="\image\{{$service->imgLink}}" alt="product-image">
						</figure>
						<!-- /PRODUCT PREVIEW IMAGE -->

						<!-- PRODUCT SETTINGS -->
						<div class="product-settings primary dropdown-handle">
							<span class="sl-icon icon-settings"></span>
						</div>
						<!-- /PRODUCT SETTINGS -->
                   		 <?php
                    $link = preg_replace('/\s+/', '_', $service->title);
                    ?>
						<!-- DROPDOWN -->
						<ul class="dropdown small hover-effect closed">
							<li class="dropdown-item">
								<!-- DP TRIANGLE -->
								<div class="dp-triangle"></div>
								<!-- DP TRIANGLE -->
								<a href="/{{$user->username}}/{{$link}}/{{$service->id}}/edit">Edit Item</a>
							</li>
							<li class="dropdown-item">
								<a href="#">Share</a>
							</li>
							<li class="dropdown-item">
								<a href="/{{$user->username}}/{{$link}}/{{$service->id}}/delete">Delete</a>
							</li>
						</ul>
						<!-- /DROPDOWN -->
					</div>
					<!-- /PRODUCT PREVIEW ACTIONS -->

					<!-- PRODUCT INFO -->
					<div class="product-info">
						<a href="/{{$user->username}}/{{$link}}/{{$service->id}}">
							<p style="height:31px;" class="text-header">{{$service->title}}</p>
						</a>
					
						<a href="shop-gridview-v1.html">
							<p class="category primary">{{$service->category->name}}</p>
						</a>
						<p class="price"><span>$</span>{{$service->packages->first()->price}}</p>
					</div>
					<!-- /PRODUCT INFO -->
					<hr class="line-separator">

					<!-- USER RATING -->
					<div class="user-rating">
						<a href="author-profile.html">
							<figure class="user-avatar small">
								<img src="\image\{{$service->user->picLink}}" alt="user-avatar">
							</figure>
						</a>
						<a href="author-profile.html">
							<p class="text-header tiny">{{$user->name}}</p>
						</a>
						<ul class="rating tooltip" title="Author's Reputation">
							<li class="rating-item empty">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
							<li class="rating-item empty">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
							<li class="rating-item empty">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
							<li class="rating-item empty">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
							<li class="rating-item empty">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
						</ul>
					</div>
					<!-- /USER RATING -->
				</div>
				<!-- /PRODUCT ITEM -->
				@endforeach

			</div>

			<!-- /PRODUCT LIST -->

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
</body>
</html>