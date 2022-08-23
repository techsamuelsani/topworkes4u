<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="css\vendor\simple-line-icons.css">
	<link rel="stylesheet" href="css\style.css">
	<!-- favicon -->
	<link rel="icon" href="\image\favicon.ico">
	<title>Laravel | How to Shop</title>
</head>
<body>


<!-- HEADER -->
@include('header')
<!-- /HEADER -->

	<!-- SECTION HEADLINE -->
	<div class="section-headline-wrap">
		<div class="section-headline">
			<h2>How to Shop</h2>
		</div>
	</div>
	<!-- /SECTION HEADLINE -->
	

	<!-- HT BANNER WRAP -->
	<div! class="ht-banner-wrap">
	
	@if(Auth::Check()!=true)
		<!-- HT BANNER -->
		<div class="ht-banner void violet">
			<figure class="ht-banner-img1">
				<img src="images\how_to_shop_01.png" alt="">
			</figure>
		</div>
		<!-- /HT BANNER -->

		<!-- HT BANNER -->
		<div class="ht-banner">
			<!-- HT BANNER CONTENT -->
			<div class="ht-banner-content">
				<p class="text-header">Create Your Account</p>
				<p>To buy any service first you need to create your own account here. To create account click on the given link below or you can signup from home page. After creating your account you need to login then you will be able to buy services and make transactions.</p>
				<a href="/register" class="button mid dark">Create your <span class="primary">New Account</span></a>
			</div>
			<!-- /HT BANNER CONTENT -->
		</div>
		<!-- /HT BANNER -->
		@endif

		<!-- HT BANNER -->
		<div class="ht-banner void pink">
			<figure class="ht-banner-img2">
				<img src="images\how_to_shop_02.png" alt="">
			</figure>
		</div>
		<!-- /HT BANNER -->

		<!-- HT BANNER -->
		<div class="ht-banner">
			<!-- HT BANNER CONTENT -->
			<div class="ht-banner-content">
				<p class="text-header">Browse Our Shop Items</p>
				<p>You can browse and shop items by going on the following link or go in to Services tab from home page. There you can find services offered by sellers and you can even search your required services by applying many filters.</p>
				<a href="/view/services" class="button mid dark"><span class="primary">Browse</span> Services</a>
			</div>
			<!-- /HT BANNER CONTENT -->
		</div>
		<!-- /HT BANNER -->

		<!-- HT BANNER -->
	
	</div>
	<!-- /HT BANNER WRAP -->


<!-- FOOTER -->
@include('footer')
<!-- /FOOTER -->


	<div class="shadow-film closed"></div>

<!-- SVG ARROW -->
<svg style="display: none;">	
	<symbol id="svg-arrow" viewbox="0 0 3.923 6.64014" preserveaspectratio="xMinYMin meet">
		<path d="M3.711,2.92L0.994,0.202c-0.215-0.213-0.562-0.213-0.776,0c-0.215,0.215-0.215,0.562,0,0.777l2.329,2.329
			L0.217,5.638c-0.215,0.215-0.214,0.562,0,0.776c0.214,0.214,0.562,0.215,0.776,0l2.717-2.718C3.925,3.482,3.925,3.135,3.711,2.92z"></path>
	</symbol>
</svg>
<!-- /SVG ARROW -->

<!-- SVG STAR -->
<svg style="display: none;">
	<symbol id="svg-star" viewbox="0 0 10 10" preserveaspectratio="xMinYMin meet">	
		<polygon points="4.994,0.249 6.538,3.376 9.99,3.878 7.492,6.313 8.082,9.751 4.994,8.129 1.907,9.751 
	2.495,6.313 -0.002,3.878 3.45,3.376 "></polygon>
	</symbol>
</svg>
<!-- /SVG STAR -->

<!-- SVG PLUS -->
<svg style="display: none;">
	<symbol id="svg-plus" viewbox="0 0 13 13" preserveaspectratio="xMinYMin meet">
		<rect x="5" width="3" height="13"></rect>
		<rect y="5" width="13" height="3"></rect>
	</symbol>
</svg>
<!-- /SVG PLUS -->



</html>