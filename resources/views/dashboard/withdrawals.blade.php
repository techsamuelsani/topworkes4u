<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="\css\vendor\simple-line-icons.css">
	<link rel="stylesheet" href="\css\style.css">
	<!-- favicon -->
	<link rel="icon" href="\image\favicon.ico">
	<title>Lancerr | Withdrawal</title>
	<style>
		.error{
			color: brown;
			font-size: 18px;
		}
	</style>

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
		<?php $user=Auth::user(); ?>
        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline simple primary">
                <h4>Withdrawals</h4>
            </div>
            <!-- /HEADLINE -->

			<!-- FORM BOX ITEMS -->
			<div class="">
				<!-- FORM BOX ITEM -->
				<div style="width: 100%;" class="form-box-item">
					<h4>Request Withdrawal</h4>
					@foreach($errors->all() as $error)
						<lable class="error">*{{$error}}</lable><br/>
					@endforeach
					<hr class="line-separator">
					<form disabled="true" method="post" action="" id="withdraw-form">
						@csrf
						<h3>You have ${{$user->balance}} available to withdrawal request</h3><br>
						<hr class="line-separator">
						@if($user->ifHasPandingWithdrawal())
						<center><h6 style="color:#bf800c">Your request is in progress</h6></center>
						@elseif($user->balance>=50)
						<!-- INPUT CONTAINER -->
						<div class="input-container">
							<label for="amount" class="rl-label required">Payoneer Email</label>
							<input type="email" id="email" name="email" placeholder="Enter your payoneer email...">
						</div>
						<!-- /INPUT CONTAINER -->
						<hr class="line-separator">

						<button class="button big dark">Request <span class="primary">Withdrawal</span></button>
						@else
						<center><h6 style="color: #f42a50">You can Withdrawal minimum of $50</h6></center>
						@endif
					</form>
				</div>
				<!-- /FORM BOX ITEM -->

				<!-- FORM BOX ITEM -->
				<div class="form-box-item withdraw-history">
					<h4>Withdrawals History</h4>
					<hr class="line-separator">
					<!-- TRANSACTION HISTORY -->
					<div class="transaction-history">
						<table style="width: 100%;" cellspacing="10px;" border="1">
							<tr style="font-size: 24px;"><td>Date</td><td>Email</td><td>Amount</td><td>Status</td><td>Comment</td></tr>
						<hr class="line-separator">
						@foreach($withdrawals as $withdrawal)
						<tr style="border-bottom: 2px solid black; color:#5e5e5e;"><td>{{ date('F d, Y \a\t h:i a', strtotime($withdrawal->created_at)) }}</td><td>{{$withdrawal->email}}</td><td>{{$withdrawal->amount}}</td><td>{{$withdrawal->status}}</td><td>{{$withdrawal->comment}}</td></tr>
						@endforeach
						</table>

					</div>
					<!-- /TRANSACTION HISTORY -->
				</div>
				<!-- /FORM BOX ITEM -->
			</div>
			<!-- /FORM BOX ITEMS -->
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
<!-- Side Menu -->
<script src="\js\side-menu.js"></script>
<!-- Dashboard Header -->
<script src="\js\dashboard-header.js"></script>
</body>
</html>