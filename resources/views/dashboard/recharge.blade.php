<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="\css\vendor\simple-line-icons.css">
	<link rel="stylesheet" href="\css\style.css">
	<!-- favicon -->
	<link rel="icon" href="\image\favicon.ico">
	<title>Lancerr | Recharge</title>
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

        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline simple primary">
                <h4>Recharge</h4>
            </div>
            <!-- /HEADLINE -->

			<!-- FORM BOX ITEMS -->
			<div class="form-box-items">
				<!-- FORM BOX ITEM -->
				<div class="form-box-item">
					<h4>Request Recharge</h4>
					@foreach($errors->all() as $error)
						<lable class="error">*{{$error}}</lable><br/>
					@endforeach
					<hr class="line-separator">
					<form disabled="true" method="post" action="" id="withdraw-form">
						@csrf
						<!-- INPUT CONTAINER -->
						<div class="input-container">
							<label for="amount" class="rl-label required">Recharged Amount</label>
							<input type="number" id="amount" name="amount" min="0" step="any" placeholder="Enter the amount youre charged...">
						</div>
						<!-- /INPUT CONTAINER -->
						<hr class="line-separator">

						<!-- INPUT CONTAINER -->
						<div class="input-container">
							<label class="rl-label required">Choose Cellular </label>
							<!-- RADIO -->
							<input type="radio" id="easyPasia" name="cellular" value="easyPasia" checked="">
							<label for="easyPasia">
								<span class="radio primary"><span></span></span>
								Easy Pasia
							</label>
							<!-- /RADIO -->

							<!-- RADIO -->
							<input type="radio" id="jazzCash" name="cellular" value="jazzCash">
							<label for="jazzCash">
								<span class="radio primary"><span></span></span>
								Jazz Cash
							</label>
							<!-- /RADIO -->

							<!-- RADIO -->
							<input type="radio" id="omini" name="cellular" value="omini">
							<label for="omini">
								<span class="radio primary"><span></span></span>
								Omini pay
							</label>
							<!-- /RADIO -->
						</div>
						<!-- /INPUT CONTAINER -->

						<hr class="line-separator">

						<!-- INPUT CONTAINER -->
						<div class="input-container">
							<label for="pp_ac" class="rl-label required">Date when recharged</label>
							<input type="date" id="date" name="date" placeholder="Enter date when recharged...">
						</div>
						<!-- /INPUT CONTAINER -->

						<!-- INPUT CONTAINER -->
						<div class="input-container">
							<label for="sendNumber" class="rl-label required">Sender Number</label>
							<input type="number" id="number" name="senderNumber" placeholder="Enter sender number/CNIC...">
						</div>
						<!-- /INPUT CONTAINER -->

						<!-- INPUT CONTAINER -->
						<div class="input-container">
								<label for="sendNumber" class="rl-label required">Transaction Number</label>
								<input type="number" id="transaction" name="transactionNo" placeholder="Enter transaction number...">
							</div>
						<!-- /INPUT CONTAINER -->

						<hr class="line-separator">

						<button class="button big dark">Request <span class="primary">Recharge</span></button>
					</form>
				</div>
				<!-- /FORM BOX ITEM -->

				<!-- FORM BOX ITEM -->
				<div class="form-box-item withdraw-history">
					<h4>Requests History</h4>
					<hr class="line-separator">
					<!-- TRANSACTION HISTORY -->
					<div class="transaction-history">
						<!-- TRANSACTION HISTORY ITEM -->
						<div class="transaction-history-item">
							<div class="transaction-history-item-date">
								<p style="color:black;">Date</p>
							</div>
							<div class="transaction-history-item-date">
								<p style="color:black;">Transaction No</p>
							</div>
							<div class="transaction-history-item-amount">
								<p style="color:black;" class="text-header">Amount</p>
							</div>
							<div class="transaction-history-item-amount">
								<p style="color:black;" class="text-header">Status</p>
							</div>
						</div>
						<!-- /TRANSACTION HISTORY ITEM -->
						@foreach($recharges as $recharge)
						<!-- TRANSACTION HISTORY ITEM -->
						<div class="transaction-history-item">
							<div class="transaction-history-item-date">
								<p>{{ date('F d, Y', strtotime($recharge->created_at)) }}</p>
							</div>
							<div class="transaction-history-item-date">
								<p>{{$recharge->transactionId}}</p>
							</div>
							<div class="transaction-history-item-amount">
								<p class="text-header">Rs. {{$recharge->amount}}</p>
							</div>
							<div class="transaction-history-item-amount">
								@if($recharge->status==0)
								<p class="text-header">Pending</p>
								@elseif($recharge->status==1)
								<p class="text-header primary">Recharged</p>
								@else
								<p class="text-header error">Rejected</p>
								@endif
							</div>
						</div>
						<!-- /TRANSACTION HISTORY ITEM -->
						@endforeach


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