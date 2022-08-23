<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="\css\vendor\simple-line-icons.css">
	<link rel="stylesheet" href="\css\vendor\tooltipster.css">
	<link rel="stylesheet" href="\css\vendor\owl.carousel.css">
	<link rel="stylesheet" href="\css\style.css">
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
				<img src="\images\logo.png" alt="logo">
			</figure>
		</a>
		<!-- /LOGO -->

		<!-- MOBILE MENU HANDLER -->
		<div class="mobile-menu-handler left primary">
			<img src="\images\pull-icon.png" alt="pull-icon">
		</div>
		<!-- /MOBILE MENU HANDLER -->

		<!-- LOGO MOBILE -->
		<a href="/">
			<figure class="logo-mobile">
				<img src="\images\logo_mobile.png" alt="logo-mobile">
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
			<img src="\images\logo.png" alt="logo">
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
			<a href="/">Home</a>
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="\how">How to Shop</a>
		</li>
		<!-- /DROPDOWN ITEM -->


		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="\services">Services</a>
		</li>
	




	</ul>
	<!-- /DROPDOWN -->
</div>
<!-- /SIDE MENU -->



	<br />
<div class="form-popup">
	<!-- CLOSE BTN -->

	<!-- /CLOSE BTN -->

	<!-- FORM POPUP CONTENT -->
	<div class="form-popup-content">
		<h4 class="popup-title">{{ __('Reset Password') }}</h4>
		<!-- LINE SEPARATOR -->
		<hr class="line-separator short">

		<!-- /LINE SEPARATOR -->

		<form method="POST" action="{{ route('password.request') }}">
			@csrf
			<input type="hidden" name="token" value="{{ $token }}">
			
			<label for="email_address" class="rl-label">{{ __('E-Mail Address') }}</label>
			<input id="email" placeholder="Your email..." type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email or old('email') }}" required autofocus>

			@if ($errors->has('email'))
				<span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
			@endif
			<label for="password" class="rl-label">{{ __('Password') }}</label>
			<input id="password" placeholder="new password.." type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

			@if ($errors->has('password'))
				<span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
			@endif
			<label for="password-confirm" class="rl-label">{{ __('Confirm Password') }}</label>
			<input id="password-confirm" placeholder="write again..." type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

			@if ($errors->has('password_confirmation'))
				<span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
			@endif


			<button type="submit" class="button mid dark no-space">
				Reset Password
			</button>
		</form>
	</div>
	<!-- /FORM POPUP CONTENT -->
</div>
	<br />

	<!-- FOOTER -->
		@include('footer')
	<!-- /FOOTER -->

	<div class="shadow-film closed"></div>



<!-- jQuery -->
<script src="\js\vendor\jquery-3.1.0.min.js"></script>
<!-- Tooltipster -->
<!-- Footer -->
<script src="\js\footer.js"></script>
</body>
</html>