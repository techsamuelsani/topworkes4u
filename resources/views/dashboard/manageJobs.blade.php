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
                <h4>Manage Your Jobs ({{count($jobs)}})</h4>
            </div>
            <!-- /HEADLINE -->

			<!-- PRODUCT LIST -->

			<div class="product-list grid column4-wrap">
				<!-- PRODUCT ITEM -->
				<a href="/job/add">
				<div style="padding: 10px !important; max-height: 150px;" class="product-item upload-new column">

					<!-- PRODUCT INFO -->
					<div class="product-info">
						<p class="text-header">Upload New Job</p>
						<p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
					</div>
					<!-- /PRODUCT INFO -->
				</div>
				</a>

				<!-- /PRODUCT ITEM -->
				@foreach($jobs as $job)
				<!-- PRODUCT ITEM -->
				<div style="padding: 10px !important;" class="product-item column">

					<!-- PRODUCT INFO -->
					<div class="product-info">
						<a href="/job/view/{{$job->id}}">
							<p class="text-header">{{$job->title}}</p>
						</a>
						<p style="height: 32px; overflow:hidden;" class="product-description">{{$job->details}}</p>
						<a>
							<p class="category primary">{{$job->category->name}}</p>
						</a>
						<p class="price"><span>$</span>{{$job->budget}}</p>
					</div>
					<!-- /PRODUCT INFO -->
					<hr class="line-separator">

					<!-- USER RATING -->
					<div class="user-rating">
						<a >
							<figure class="user-avatar small">
								<img src="\image\{{$user->picLink}}" alt="user-avatar">
							</figure>
						</a>
						<a href="">
							<p class="text-header tiny">{{$user->name}}</p>
						</a>
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