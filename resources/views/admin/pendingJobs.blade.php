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
                <h4>Pending Seller Requests</h4>

            </div>
            <!-- /HEADLINE -->



			<!-- TRANSACTION LIST -->
			<div class="transaction-list">
				<!-- TRANSACTION LIST HEADER -->
				<div class="transaction-list-header">
					<div style="margin-left: 5px;" class="transaction-list-header-code">
						<p class="text-header small">Date</p>
					</div>
					<div  class="transaction-list-header-code">
						<p class="text-header small">Name</p>
					</div>
					<div style="width: 220px"  class="transaction-list-header-date">
						<p class="text-header small">Title</p>
					</div>
					<div class="transaction-list-header-item">
						<p class="text-header small">Details</p>
					</div>
					<div class="transaction-list-header-item">
						<p class="text-header small">Requirements</p>
					</div>
					<div class="transaction-list-header-detail">
						<p class="text-header small">Category</p>
					</div>
					<div class="transaction-list-header-code">
						<p class="text-header small">Action</p>
					</div>


				</div>
				<!-- /TRANSACTION LIST HEADER -->
				@foreach($jobs as $job)
				<!-- TRANSACTION LIST ITEM -->
				<div style="height: auto; border-bottom: none;" class="transaction-list-item">
					<div style="margin-left: 5px;" class="transaction-list-item-code">
						<p style="line-height:13px;">{{ date('F d, Y', strtotime($job->created_at)) }}</p>
					</div>
					<div  class="transaction-list-item-code">
						<p style="line-height:13px;" class="text-header"><a href="/{{$job->user->username}}">{{$job->user->name}}</a></p>
					</div>
					<div style="width: 220px" class="transaction-list-item-date">
						<p style="line-height:13px;" class="category primary">{{$job->title}}</p>
					</div>
					<div class="transaction-list-item-item">
						<p style="line-height:13px;" >{{$job->details}}</p>
					</div>
					<div class="transaction-list-item-item">
						<p style="line-height:13px;" >{{$job->requirements}}</p>
					</div>
					<div class="transaction-list-item-detail">
						<p style="line-height:13px;" >{{$job->category->name}}</p>
					</div>
					<div class="transaction-list-item-code">
						<form method="post" action="">
							@csrf
							<input type="hidden" value="{{$job->id}}" name="jobId">
							<input type="submit" style="color: #03f1b6; background-color:white; font-size: 16px;" class=" primary" value="Accept" name="action">
						</form>
						<form method="post" action="">
							@csrf
							<input type="hidden" value="{{$job->id}}" name="jobId">
							<input type="submit" style="color: #f8436e; background-color:white; font-size: 16px; margin-bottom: 10px;" class=" primary" value="Reject" name="action">
						</form>

					</div>

				</div>
				<div class="clearfix"></div>
				<!-- /TRANSACTION LIST ITEM -->
				@endforeach

			</div>
			<!-- /TRANSACTION LIST -->
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