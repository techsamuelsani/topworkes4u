<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="css\vendor\simple-line-icons.css">
	<link rel="stylesheet" href="css\vendor\tooltipster.css">
	<link rel="stylesheet" href="css\vendor\owl.carousel.css">
	<link rel="stylesheet" href="css\style.css">
	<!-- favicon -->
	<link rel="icon" href="\image\favicon.ico">
	<title>Login | Lancerr.net</title>
	<style>
		.invalid-feedback{
			color: brown;
			font-size: 18px;
		}
	</style>
</head>
<body>

<div class="header-wrap">
	<header>
		<!-- LOGO -->
		<a href="/">
			<figure class="logo">
				<img src="images\logo.png" alt="logo">
			</figure>
		</a>
		<!-- /LOGO -->

		<!-- MOBILE MENU HANDLER -->
		<div class="mobile-menu-handler left primary">
			<img src="images\pull-icon.png" alt="pull-icon">
		</div>
		<!-- /MOBILE MENU HANDLER -->

		<!-- LOGO MOBILE -->
		<a href="/">
			<figure class="logo-mobile">
				<img src="images\logo_mobile.png" alt="logo-mobile">
			</figure>
		</a>
		<!-- /LOGO MOBILE -->

	</header>
</div>



<!-- SIDE MENU -->
<div id="mobile-menu" class="side-menu left closed">
	<!-- SVG PLUS -->
	<svg class="svg-plus">
		<use xlink:href="#svg-plus"></use>
	</svg>
	<!-- /SVG PLUS -->

	<!-- SIDE MENU HEADER -->
	<div class="side-menu-header">
		<figure class="logo small">
			<img src="images\logo.png" alt="logo">
		</figure>
	</div>
	<!-- /SIDE MENU HEADER -->

	<!-- SIDE MENU TITLE -->
	<p class="side-menu-title">Main Links</p>
	<!-- /SIDE MENU TITLE -->

	<!-- DROPDOWN -->
	<ul class="dropdown dark hover-effect interactive">
		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="index-1.html">Home</a>
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="how-to-shop.html">How to Shop</a>
		</li>
		<!-- /DROPDOWN ITEM -->


		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="services.html">Services</a>
		</li>
		<!-- /DROPDOWN ITEM -->




	</ul>
	<!-- /DROPDOWN -->
</div>
<!-- /SIDE MENU -->



	<br />
	<div class="form-popup">
		<!-- CLOSE BTN -->

		<!-- /CLOSE BTN -->
		<div class="form-popup-headline secondary">
			<h2>Login to your Account</h2>
			<p>Enter now to your account and start buying and selling!</p>
		</div>
		<!-- FORM POPUP CONTENT -->
		<div class="form-popup-content">
			<form id="login-form" method="POST" action="{{ route('login') }}">
				@csrf
				<label for="username" class="rl-label">Email</label>
				<input type="email" id="email" name="email" required autofocus placeholder="Enter your email here...">
				<label for="password" class="rl-label">Password</label>
				<input type="password" id="password" name="password" placeholder="Enter your password here...">
				@if ($errors->has('email'))
				    <!-- LINE SEPARATOR -->
					<hr class="line-separator double">
					<!-- /LINE SEPARATOR -->
					<span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
				@if ($errors->has('password'))
					<span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
					</span>
		    	@endif
			    <!-- LINE SEPARATOR -->
				<hr class="line-separator double">
				<!-- /LINE SEPARATOR -->
				<!-- CHECKBOX -->
				<input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
				<label for="remember" class="label-check">
					<span class="checkbox primary primary"><span></span></span>
					Remember Email and password
				</label>
				<!-- /CHECKBOX -->
				<p>Forgot your password? <a href="{{ route('password.request') }}" class="primary">Click here!</a></p>
				<button type="submit" class="button mid dark">Login <span class="primary">Now!</span></button>
			</form>
			<!-- LINE SEPARATOR -->
			<hr class="line-separator double">
			<!-- /LINE SEPARATOR -->
			<a href="/register" class="button mid primary">Register <span class="secondary">Now!</span></a>


		</div>
		<!-- /FORM POPUP CONTENT -->
	</div>
	<br />

	<!-- FOOTER -->
		@include('footer')
	<!-- /FOOTER -->

	<div class="shadow-film closed"></div>



<!-- jQuery -->
<script src="js\vendor\jquery-3.1.0.min.js"></script>
<!-- Tooltipster -->
<script src="js\vendor\jquery.tooltipster.min.js"></script>
<!-- Owl Carousel -->
<script src="js\vendor\owl.carousel.min.js"></script>
<!-- Tweet -->
<script src="js\vendor\twitter\jquery.tweet.min.js"></script>
<!-- xmAlerts -->
<script src="js\vendor\jquery.xmalert.min.js"></script>
<!-- Side Menu -->
<script src="js\side-menu.js"></script>
<!-- Home -->
<script src="js\home.js"></script>
<!-- Tooltip -->
<script src="js\tooltip.js"></script>
<!-- User Quickview Dropdown -->
<script src="js\user-board.js"></script>

<!-- Footer -->
<script src="js\footer.js"></script>
</body>
</html>