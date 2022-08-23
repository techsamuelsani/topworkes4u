<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="\css\vendor\simple-line-icons.css">
	<link rel="stylesheet" href="\css\style.css">
	<!-- favicon -->
	<link rel="icon" href="\image\favicon.ico">
	<title>Lancerr | Settings</title>
	<style>
		.upload-btn-wrapper {
			position: relative;
			overflow: hidden;
			display: inline-block;
			width: 100%;
		}

		.upbtn {
			border: 2px solid gray;
			color: gray;
			background-color: white;
			padding: 8px 20px;
			border-radius: 8px;
			font-size: 20px;
			width: 100%;
			font-weight: bold;
		}

		.upload-btn-wrapper input[type=file] {
			font-size: 35px;
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

	<!-- SIDE MENU -->
	@include('dashboard.side');
	<!-- /SIDE MENU -->

    <!-- DASHBOARD BODY -->
    <div class="dashboard-body">
        <!-- DASHBOARD HEADER -->
        @include('dashboard.header')
        <!-- DASHBOARD HEADER -->

        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content">
            <!-- HEADLINE -->
            <div class="headline buttons primary">
                <h4>Account Settings</h4>
				<button form="profile-info-form" class="button mid-short primary">Save Changes</button>
            </div>
            <!-- /HEADLINE -->

			<!-- FORM BOX ITEMS -->
			<div class="form-box-items">
				<!-- FORM BOX ITEM -->
				<div style="width: 100%;" class="form-box-item">
					@if(Session::has('alert'))
							<lable class='error'>*{{ Session::get('alert') }}</lable><br/>
						@endif
					@foreach($errors->all() as $error)
						<lable class="error">*{{$error}}</lable><br/>
					@endforeach
					<br />
					<h4>Profile Information</h4>

					<form method="post" enctype="multipart/form-data" action="settings/image">
						@csrf
					<hr class="line-separator">
					<!-- PROFILE IMAGE UPLOAD -->
					<div class="profile-image">
						<div style="display: inline-block;" class="profile-image-data">
							<figure class="user-avatar medium">
                                <img style="height: 60px; width: 60px;" @if($user->picLink != null) src="\image\{{$user->picLink}}" @else src="\images\dashboard\profile-default-image.png" @endif alt="profile-default-image">
							</figure>
							<p class="text-header">Profile Photo</p>
							<p class="upload-details">Minimum size 70x70px</p>
						</div>
						<!-- UPLOAD FILE -->
						<div style="width: 200px; padding-left: 10px; padding-top: 10px; display: inline-block;">
							<div class="upload-file-actions">
								<div class="upload-btn-wrapper">
									<button class="upbtn big">Select Image</button>
									<input type="file" name="image" />
								</div>
							</div>

						</div>
						<div style="display: inline-block; margin: 0px !important;"><button  style="height:43px; margin: 0px !important; padding: 0px !important;" class="button primary" >Upload Image</button></div>

						<!-- UPLOAD FILE -->
					</div>
					<!-- PROFILE IMAGE UPLOAD -->
					</form>
					<hr class="line-separator">
					<form id="profile-info-form" method="post" action="">
						@csrf
						<!-- INPUT CONTAINER -->
						<div class="input-container half">
							<label for="acc_name" class="rl-label required">Account Name</label>
							<input type="text" id="acc_name" name="name" value="{{$user->name}}" placeholder="Enter your account name here...">
						</div>
						<!-- /INPUT CONTAINER -->

						<!-- INPUT CONTAINER -->
						<div class="input-container half">
								<label for="acc_name" class="rl-label required">Username</label>
								<input type="text" id="acc_name" name="username" value="{{$user->username}}" placeholder="Enter your  username here...">
						</div>
						<!-- /INPUT CONTAINER -->
							<div class="clearfix"></div>


						<!-- INPUT CONTAINER -->
						<div class="input-container half">
							<label for="new_email" class="rl-label">Email</label>
							<input type="email" id="new_email" value="{{$user->email}}" name="email" placeholder="Enter your email address here...">
						</div>
						<!-- /INPUT CONTAINER -->

						<!-- INPUT CONTAINER -->

						<div class="input-container half">
							<label for="website_url" class="rl-label">Date of birth</label>
							<input type="date" style="font-size: 18px;" id="website_url" value="{{$user->dob}}" name="dob" placeholder="Enter your birth date here...">
						</div>
						<!-- /INPUT CONTAINER -->
							<div class="clearfix"></div>
							<!-- INPUT CONTAINER -->
							<div class="input-container half">
								<label for="counrty" class="rl-label required">Country</label>
								<input type="text" required id="acc_name" name="country" value="{{$user->country}}" placeholder="Enter your country name here...">
							</div>
							<!-- /INPUT CONTAINER -->

							<!-- INPUT CONTAINER -->
							<div class="input-container half">
								<label for="city" class="rl-label required">City</label>
								<input type="text" id="city" name="city" value="{{$user->city}}" placeholder="Enter your  City here...">
							</div>
							<!-- /INPUT CONTAINER -->
							<div class="clearfix"></div>
							<!-- INPUT CONTAINER -->
							<div class="input-container half">
								<label for="state" class="rl-label required">State</label>
								<input type="text" id="state" name="state" value="{{$user->state}}" placeholder="Enter your state name...">
							</div>
							<!-- /INPUT CONTAINER -->
							<!-- INPUT CONTAINER -->
							<div class="input-container half">
								<label for="address" class="rl-label required">Street Address</label>
								<input type="text" id="address" name="address" value="{{$user->address}}" placeholder="Enter your street address...">
							</div>
							<!-- /INPUT CONTAINER -->
							<div class="clearfix"></div>

							<!-- INPUT CONTAINER -->
							<div class="input-container half">
								<label for="zip" class="rl-label required">Zip</label>
								<input type="number" id="zip" name="zip" value="{{$user->zip}}" placeholder="Enter your  zip code...">
							</div>
							<!-- /INPUT CONTAINER -->
							<!-- INPUT CONTAINER -->
							<div class="input-container half">
								<label for="phone" class="rl-label required">Phone No.</label>
								<input type="number" id="phone" name="phone" value="{{$user->phone}}" placeholder="Enter your  phone number...">
							</div>
							<!-- /INPUT CONTAINER -->
							<div class="clearfix"></div>


							<button class="button primary big">Save Information</button>
					</form>
					<br/>
					<hr class="line-separator">
					<form id="profile-info-form" method="post" action="settings/password">
						@csrf
						<!-- INPUT CONTAINER -->
							<div class="input-container">
								<label for="pld" class="rl-label">Old Password</label>
								<input type="password" id="old" name="old_password" placeholder="Enter your password here...">
							</div>
							<!-- /INPUT CONTAINER -->

						<!-- INPUT CONTAINER -->
						<div class="input-container half">
							<label for="new_pwd" class="rl-label">New Password</label>
							<input type="password" id="new_pwd" name="password" placeholder="Enter your password here...">
						</div>
						<!-- /INPUT CONTAINER -->

						<!-- INPUT CONTAINER -->
						<div class="input-container half">
							<label for="new_pwd2" class="rl-label">Confirm Password</label>
							<input type="password" id="new_pwd2" name="password_confirmation" placeholder="Repeat your password here...">
						</div>
						<!-- /INPUT CONTAINER -->
						<button class="button big dark">Update Password</button>

					</form>
				</div>
				<!-- /FORM BOX ITEM -->

			</div>
			<!-- /FORM BOX -->
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