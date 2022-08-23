<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="\css\vendor\bootstrap-datepicker3.standalone.min.css">
    <link rel="stylesheet" href="\css\vendor\simple-line-icons.css">
	<link rel="stylesheet" href="\css\style.css">
	<!-- favicon -->
	<link rel="icon" href="\image\favicon.ico">
	<title>Lancerr.net | Admin</title>
</head>
<body>

@include('admin.side');

    <!-- DASHBOARD BODY -->
    <div class="dashboard-body">
		<!-- DASHBOARD HEADER -->
		<div class="dashboard-header retracted">
			<!-- DB CLOSE BUTTON -->
			<a href="\admin" class="db-close-button">
				<img src="\images\dashboard\back-icon.png" alt="back-icon">
			</a>
			<!-- DB CLOSE BUTTON -->

			<!-- DB OPTIONS BUTTON -->
			<div class="db-options-button">
				<img src="\images\dashboard\db-list-right.png" alt="db-list-right">
				<img src="\images\dashboard\close-icon.png" alt="close-icon">
			</div>
			<!-- DB OPTIONS BUTTON -->

			<!-- DASHBOARD HEADER ITEM -->
			<div style="width: 100%;" class="dashboard-header-item title">
				<!-- DB SIDE MENU HANDLER -->
				<div class="db-side-menu-handler">
					<img src="\images\dashboard\db-list-left.png" alt="db-list-left">
				</div>
				<!-- /DB SIDE MENU HANDLER -->
				<h6>Your Dashboard</h6>
			</div>
			<!-- /DASHBOARD HEADER ITEM -->





			<!-- DASHBOARD HEADER ITEM -->
			<div class="dashboard-header-item back-button">
				<a href="index-1.html" class="button mid dark-light">Back to Homepage</a>
			</div>
			<!-- /DASHBOARD HEADER ITEM -->
		</div>
		<!-- DASHBOARD HEADER -->

        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline statement primary">
                <h4>Pending Service</h4>

            </div>
            <!-- /HEADLINE -->


			<!-- POST -->
			<article style="padding-bottom: 80px;" class="post">
				<!-- POST IMAGE -->
				<div class="post-image">
					<figure class="product-preview-image large">
						<img style="max-height: 500px; height: 100%" src="\image\{{$service->imgLink}}" alt="">
					</figure>
				</div>
				<!-- /POST IMAGE -->


				<hr class="line-separator">

				<!-- POST CONTENT -->
				<div class="post-content">
					<!-- POST PARAGRAPH -->
					<div class="post-paragraph">
						<h3 class="post-title">{{$service->title}}</h3>
						<p>{{$service->details}}</p>
					</div>

					<br /> <br />
					<!-- /POST PARAGRAPH -->

					<div>
						<!-- POST PARAGRAPH -->
						<div style=" margin-top: 0px !important; float: left; margin-left: 10px; width: 250px;" class="post-paragraph">
							<h3 style="color:#1cbdf9;" class="post-title small">Standard Package</h3>
							<!-- POST ITEM LIST -->
							<ul class="post-item-list">
								<li>
									<!-- SVG CHECK -->
									<svg class="svg-check bullet-icon">
										<use xlink:href="#svg-check"></use>
									</svg>
									<!-- /SVG CHECK -->
									<p>Number of days: {{$service->packages->first()->days}}</p>
								</li>
								<li>
									<!-- SVG CHECK -->
									<svg class="svg-check bullet-icon">
										<use xlink:href="#svg-check"></use>
									</svg>
									<!-- /SVG CHECK -->
									<p>Number of Revisions: {{$service->packages->first()->revisions}}</p>
								</li>
								<li>
									<strong>Detail:</strong>
									<p>{{$service->packages->first()->detail}}</p>
								</li>
							</ul>
							<!-- POST ITEM LIST -->
						</div>
						<!-- /POST PARAGRAPH -->
						<?php $count=count($service->packages); ?>
					@if($count>=2)
						<!-- POST PARAGRAPH -->
							<div style="margin-top: 0px !important; margin-left: 10px; float: left; width: 250px;" class="post-paragraph">
								<h3 style="color:#1cbdf9;" class="post-title small">Premium Package</h3>
								<!-- POST ITEM LIST -->
								<ul class="post-item-list">
									<li>
										<!-- SVG CHECK -->
										<svg class="svg-check bullet-icon">
											<use xlink:href="#svg-check"></use>
										</svg>
										<!-- /SVG CHECK -->
										<p>Number of days: {{$package[1]->days}}</p>
									</li>
									<li>
										<!-- SVG CHECK -->
										<svg class="svg-check bullet-icon">
											<use xlink:href="#svg-check"></use>
										</svg>
										<!-- /SVG CHECK -->
										<p>Number of Revisions: {{$package[1]->revisions}}</p>
									</li>
									<li>
										<strong>Detail:</strong>
										<p>{{$package[1]->detail}}</p>
									</li>
								</ul>
								<!-- POST ITEM LIST -->
							</div>
							<!-- /POST PARAGRAPH -->
					@endif
					@if($count>=3)
						<!-- POST PARAGRAPH -->
							<div style=" margin-top: 0px !important; margin-left: 10px; float: left; width: 250px;" class="post-paragraph">
								<h3 style="color:#1cbdf9;"  class="post-title  small">Diamond Package</h3>
								<!-- POST ITEM LIST -->
								<ul class="post-item-list">
									<li>
										<!-- SVG CHECK -->
										<svg class="svg-check bullet-icon">
											<use xlink:href="#svg-check"></use>
										</svg>
										<!-- /SVG CHECK -->
										<p>Number of days: {{$package[2]->days}}</p>
									</li>
									<li>
										<!-- SVG CHECK -->
										<svg class="svg-check bullet-icon">
											<use xlink:href="#svg-check"></use>
										</svg>
										<!-- /SVG CHECK -->
										<p>Number of Revisions: {{$package[2]->revisions}}</p>
									</li>
									<li>
										<strong>Detail:</strong>
										<p>{{$package[2]->detail}}</p>
									</li>
								</ul>
								<!-- POST ITEM LIST -->
							</div>
							<!-- /POST PARAGRAPH -->
						@endif


					</div>
					<div class="clearfix"></div>



				</div>
				<!-- /POST CONTENT -->

				<hr class="line-separator">
				<br>
				<form style="float: left; margin-left: 100px; cursor: pointer;" action="" method="post">
					@csrf
					<input  class="button big primary" type="submit" name="action" value="Approve">
				</form>
				<form style="float: left; margin-left: 100px; cursor: pointer;" action="" method="post">
					@csrf
					<input  class="button big dark" type="submit" name="action" value="Reject">
				</form>


			</article>
			<!-- /POST -->

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

<!-- jQuery -->
<script src="\js\vendor\jquery-3.1.0.min.js"></script>
<!-- XM Pie Chart -->
<script src="\js\vendor\jquery.xmpiechart.min.js"></script>
<!-- Bootstrap Datepicker -->
<script src="\js\vendor\bootstrap-datepicker.min.js"></script>
<!-- Side Menu -->
<script src="\js\side-menu.js"></script>
<!-- Dashboard Header -->
<script src="\js\dashboard-header.js"></script>
<!-- Dashboard Statement -->
<script src="\js\dashboard-statement.js"></script>
</body>
</html>