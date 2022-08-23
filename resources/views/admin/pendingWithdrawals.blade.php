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
<div id="accept" style="display: none; position: absolute; box-shadow: 0px 0px 20px #21282a; z-index: 9999; top:150px; left: 40%;">
	<div class="mfp-bg mfp-fade mfp-ready"></div>
	<div class="mfp-wrap mfp-close-btn-in mfp-auto-cursor mfp-fade mfp-ready" tabindex="-1" style="overflow-x: hidden; overflow-y: auto;"><div class="mfp-container mfp-s-ready mfp-inline-holder"><div class="mfp-content"><div id="new-message-popup" class="form-popup new-message">
					<!-- FORM POPUP CONTENT -->
					<div class="form-popup-content">
						<h4 class="popup-title">Withdrawal Info: &nbsp; &nbsp; &nbsp;<small class="ttitle"></small></h4>
						<!-- LINE SEPARATOR -->
						<hr class="line-separator">
						<!-- /LINE SEPARATOR -->
						<form method="post" action="" class="new-message-form">
							@csrf
							<input class="withdrawal_id" type="hidden" value="" name="withdrawal_id">

							<div style="float: left; width: 99%; padding: 5px;" class="input-container">
								<label for="price" class="rl-label required">Price</label>
								<input type="number" id="transaction" required name="transaction" placeholder="Enter transaction No...">
							</div>
							<div class="clearfix"></div>
							<div style="float: left; width: 99%; padding: 5px;" class="input-container">
								<label for="price" class="rl-label required">Comment</label>
								<input type="text" id="comment" required name="comment" placeholder="Enter Comment...">
							</div>


							<input type="submit" class="button mid dark" name="action" value="Withdarawal Sent">
						</form>
					</div>
					<!-- /FORM POPUP CONTENT -->
					<a onclick="cclose()" style="margin: 30px; padding: 12px;" class="close-btn mfp-close"><span style="color: white; position: absolute; font-size: 26px; left: 10px;">X</span></a>
				</div></div></div></div>
</div>
<div id="reject" style="display: none; position: absolute; box-shadow: 0px 0px 20px #21282a;  z-index: 9999; top:150px; left: 40%;">
	<div class="mfp-bg mfp-fade mfp-ready"></div>
	<div class="mfp-wrap mfp-close-btn-in mfp-auto-cursor mfp-fade mfp-ready" tabindex="-1" style="overflow-x: hidden; overflow-y: auto;"><div class="mfp-container mfp-s-ready mfp-inline-holder"><div class="mfp-content"><div id="new-message-popup" class="form-popup new-message">
					<!-- FORM POPUP CONTENT -->
					<div class="form-popup-content">
						<h4 class="popup-title">Withdrawal Info: &nbsp; &nbsp; &nbsp;<small class="ttitle"></small></h4>
						<!-- LINE SEPARATOR -->
						<hr class="line-separator">
						<!-- /LINE SEPARATOR -->
						<form method="post" action="" class="new-message-form">
							@csrf
							<input class="withdrawal_id" type="hidden" value="" name="withdrawal_id">

							<div class="clearfix"></div>
							<div style="float: left; width: 99%; padding: 5px;" class="input-container">
								<label for="price" class="rl-label required">Comment</label>
								<input type="text" id="comment" required name="comment" placeholder="Enter Comment...">
							</div>


							<input type="submit" name="action" class="button mid dark" value="Withdrawal not sent">
						</form>
					</div>
					<!-- /FORM POPUP CONTENT -->
					<a onclick="cclose()" style="margin: 30px; padding: 12px;" class="close-btn mfp-close"><span style="color: white; position: absolute; font-size: 26px; left: 10px;">X</span></a>
				</div></div></div></div>
</div>
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
                <h4>Pending Withdrawals</h4>

            </div>
            <!-- /HEADLINE -->



			<!-- TRANSACTION LIST -->
			<div class="transaction-list">
				<!-- TRANSACTION LIST HEADER -->
				<div class="transaction-list-header">
					<div class="transaction-list-header-date">
						<p class="text-header small">Date</p>
					</div>
					<div class="transaction-list-header-author">
						<p class="text-header small">User</p>
					</div>
					<div  class="transaction-list-header-date">
						<p class="text-header small">Email</p>
					</div>
					<div class="transaction-list-header-detail">
						<p class="text-header small">Amount</p>
					</div>
					<div class="transaction-list-header-code">
						<p class="text-header small">Action</p>
					</div>
					<div class="transaction-list-header-code">
						<p class="text-header small">Action</p>
					</div>

				</div>
				<!-- /TRANSACTION LIST HEADER -->
				@foreach($withdrawals as $withdrawal)
				<!-- TRANSACTION LIST ITEM -->
				<div style="overflow: hidden;" class="transaction-list-item">
					<div class="transaction-list-item-date">
						<p>{{ date('F d, Y', strtotime($withdrawal->updated_at)) }}</p>
					</div>
					<div class="transaction-list-item-author">
						<p class="text-header"><a href="/{{$withdrawal->user->username}}">{{$withdrawal->user->name}}</a></p>
					</div>
					<div  class="transaction-list-item-date">
						<p class="category primary">{{$withdrawal->email}}</p>
					</div>
					<div  class="transaction-list-item-detail">
						<p>{{$withdrawal->amount}}</p>
					</div>
					<div class="transaction-list-item-code">
						<Button style="color: #15e159; background-color:white; font-size: 16px; margin-top: 14px;" onclick="show('Withdrawal  ${{$withdrawal->amount}} to {{$withdrawal->user->username}}',{{$withdrawal->id}})" class=" secondary" >Accept</Button>

					</div>
					<div class="transaction-list-item-code">

						<Button style="color: #f8436e; background-color:white; font-size: 16px; margin-top: 14px;" onclick="sshow('Withdrawal ${{$withdrawal->amount}} to {{$withdrawal->user->username}}',{{$withdrawal->id}})" class=" primary" >Reject</Button>
					</div>
				</div>
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
<script>
    function show(title,id){
        $('#reject').hide();
        $('.ttitle').text(title);
        $('.withdrawal_id').val(id);
        $('#accept').show();
    }
    function sshow(title,id){
        $('#accept').hide();
        $('.ttitle').text(title);
        $('.withdrawal_id').val(id);
        $('#reject').show();
    }


    function cclose(){
        $('#accept').hide();
        $('#reject').hide();
    }
</script>
</body>
</html>