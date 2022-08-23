<?php
$user=Auth::user();
?>
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
	<link rel="icon" href="/image/favicon.ico">
	<title>Lancerr.net </title>
</head>
<body>

<!-- HEADER -->
@include('header')
<!-- /HEADER -->


<!-- BANNER -->
<div class="banner-wrap">
	<section class="banner">
		<h5>Welcome to</h5>
		<h1>The Biggest <span>Marketplace</span></h1>
		<p>Lancerr.net is a trustful marketplace which makes buying and selling easy for you.</p>
		<img src="images\top_items.png" alt="banner-img">

		<!-- SEARCH WIDGET -->
		<div class="search-widget">
			<form action="view\services" class="search-widget-form">
				<input type="text" name="search" placeholder="Search services here...">
				<label for="categories" class="select-block">
					<select onchange="selectt(this.value)" name="categories" id="categories">
						<option value="all">All Categories</option>
                        <?php $cats=App\Category::all();   ?>
						@foreach($cats as $cat)
                            <?php $name = preg_replace('/\s+/', '_', $cat->name); ?>
							<option value="{{$name}}">{{$cat->name}}</option>
						@endforeach
					</select>
					<!-- SVG ARROW -->
					<svg class="svg-arrow">
						<use xlink:href="#svg-arrow"></use>
					</svg>
					<!-- /SVG ARROW -->
				</label>
				<button class="button medium dark">Search Now!</button>
			</form>
		</div>
		<!-- /SEARCH WIDGET -->
	</section>
</div>
<!-- /BANNER -->

<!-- SERVICES -->
<div  id="services-wrap">
	<section style="min-height:0px; padding-top:80px; " id="services">
		<!-- SERVICE LIST -->
		<div class="service-list column4-wrap">
			<!-- SERVICE ITEM -->
			<div class="service-item column">
				<div class="circle medium gradient"></div>
				<div class="circle white-cover"></div>
				<div class="circle dark">
					<span class="icon-present"></span>
				</div>
				<h3>Buy &amp; Sell Easily</h3>
				<p></p>
			</div>
			<!-- /SERVICE ITEM -->

			<!-- SERVICE ITEM -->
			<div class="service-item column">
				<div class="circle medium gradient"></div>
				<div class="circle white-cover"></div>
				<div class="circle dark">
					<span class="icon-lock"></span>
				</div>
				<h3>Secure Transaction</h3>
				<p></p>
			</div>
			<!-- /SERVICE ITEM -->

			<!-- SERVICE ITEM -->
			<div class="service-item column">
				<div class="circle medium gradient"></div>
				<div class="circle white-cover"></div>
				<div class="circle dark">
					<span class="icon-like"></span>
				</div>
				<h3>Products Control</h3>
				<p></p>
			</div>
			<!-- /SERVICE ITEM -->

			<!-- SERVICE ITEM -->
			<div class="service-item column">
				<div class="circle medium gradient"></div>
				<div class="circle white-cover"></div>
				<div class="circle dark">
					<span class="icon-diamond"></span>
				</div>
				<h3>Quality Platform</h3>
				<p></p>
			</div>
			<!-- /SERVICE ITEM -->
		</div>
		<!-- /SERVICE LIST -->
		<div class="clearfix"></div>
	</section>
</div>
<!-- /SERVICES -->

<div class="clearfix"></div>

<!-- PRODUCT SIDESHOW -->
<div id="product-sideshow-wrap">
	<div id="product-sideshow">
		<!-- PRODUCT SHOWCASE -->
		<div class="product-showcase">
			<!-- HEADLINE -->
			<div class="headline primary">
				<h4>Latest Services</h4>
				<!-- SLIDE CONTROLS -->
				<div class="slide-control-wrap">
					
				</div>
				<!-- /SLIDE CONTROLS -->
				<!-- /HEADLINE -->
            <?php $count=4;?>
			@foreach($services as $service)
                <?php $link = preg_replace('/\s+/', '_', $service->title); ?>
				<!-- PRODUCT LIST -->
					@if($count%4==0)
			</div>
			<div class="clearfix"></div>
			<div id="pl-1" class="product-list grid column4-wrap">
			@endif
			<!-- PRODUCT ITEM -->
				<div class="product-item column">
					<!-- PRODUCT PREVIEW ACTIONS -->
					<div class="product-preview-actions">
						<!-- PRODUCT PREVIEW IMAGE -->
						<figure class="product-preview-image">
							<img  style="max-height: 300px; height: 100%;"  src="\image\{{$service->imgLink}}" alt="product-image">
						</figure>
						<!-- /PRODUCT PREVIEW IMAGE -->

						<!-- PREVIEW ACTIONS -->
						<div class="preview-actions">
							<!-- PREVIEW ACTION -->
							<div style="margin: auto !important; left:100px !important;" class="preview-action">
								<a href="/{{$service->user->username}}/{{$link}}/{{$service->id}}">
									<div class="circle tiny primary">
										<span class="icon-tag"></span>
									</div>
								</a>
								<a href="/{{$service->user->username}}/{{$link}}/{{$service->id}}">
									<p>Go to Item</p>
								</a>
							</div>
							<!-- /PREVIEW ACTION -->
						</div>
						<!-- /PREVIEW ACTIONS -->
					</div>
					<!-- /PRODUCT PREVIEW ACTIONS -->

					<!-- PRODUCT INFO -->
					<div class="product-info">
						<a href="/{{$service->user->username}}/{{$link}}/{{$service->id}}">
							<p style="height:31px" class="text-header">{{$service->title}}</p>
						</a>
						
						<a href="/{{$service->user->username}}/{{$link}}/{{$service->id}}">
							<p class="category primary">{{$service->category->name}}</p>
						</a>
						<p class="price"><span>$</span>{{$service->packages->first()->price}}</p>
					</div>
					<!-- /PRODUCT INFO -->
					<hr class="line-separator">

					<!-- USER RATING -->
					<div class="user-rating">
						<a href="/{{$service->user->username}}">
							<figure class="user-avatar small">
								<img style="height: 26px; width: 26px;" src="image\{{$service->user->picLink}}" alt="user-avatar">
							</figure>
						</a>
						<a href="/{{$service->user->username}}">
							<p class="text-header tiny">{{$service->user->name}}</p>
						</a>
						<ul class="rating tooltip tooltipstered" title="User's Rating">
                            <?php $averageRating=$service->user->averageRating(); ?>
							<li class="rating-item @if($averageRating < 0.5 ) empty @endif">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
							<li class="rating-item @if($averageRating < 1.5 ) empty @endif">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
							<li class="rating-item @if($averageRating < 2.5 ) empty @endif">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
							<li class="rating-item @if($averageRating < 3.5 ) empty @endif">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
							<li class="rating-item @if($averageRating < 4.5 ) empty @endif">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
						</ul>
					</div>
					<!-- /USER RATING -->
				</div>
				<!-- /PRODUCT ITEM -->

            <?php $count++; ?>
			<!-- /PRODUCT LIST -->
				@endforeach
			</div>

		</div>
		<!-- /PRODUCT SHOWCASE -->
		<div class="clearfix"></div>
		<!-- PRODUCT SHOWCASE -->
		<div class="product-showcase">
			<!-- HEADLINE -->
			<div class="headline primary">
				<h4>Trending Services</h4>
				<!-- SLIDE CONTROLS -->
				<div class="slide-control-wrap">
					
				</div>
			</div>
				<!-- /HEADLINE -->
            <?php $count=4;?>
			@foreach($trending as $service)
                <?php $link = preg_replace('/\s+/', '_', $service->title); ?>
				<!-- PRODUCT LIST -->
					@if($count%4==0)
				
			</div>
			<div class="clearfix"></div>
			<div id="pl-1" class="product-list grid column4-wrap">
			@endif
			<!-- PRODUCT ITEM -->
				<div class="product-item column">
					<!-- PRODUCT PREVIEW ACTIONS -->
					<div class="product-preview-actions">
						<!-- PRODUCT PREVIEW IMAGE -->
						<figure class="product-preview-image">
							<img  style="max-height: 300px; height: 100%;"  src="\image\{{$service->imgLink}}" alt="product-image">
						</figure>
						<!-- /PRODUCT PREVIEW IMAGE -->

						<!-- PREVIEW ACTIONS -->
						<div class="preview-actions">
							<!-- PREVIEW ACTION -->
							<div style="margin: auto !important; left:100px !important;" class="preview-action">
								<a href="/{{$service->user->username}}/{{$link}}/{{$service->id}}">
									<div class="circle tiny primary">
										<span class="icon-tag"></span>
									</div>
								</a>
								<a href="/{{$service->user->username}}/{{$link}}/{{$service->id}}">
									<p>Go to Item</p>
								</a>
							</div>
							<!-- /PREVIEW ACTION -->
						</div>
						<!-- /PREVIEW ACTIONS -->
					</div>
					<!-- /PRODUCT PREVIEW ACTIONS -->

					<!-- PRODUCT INFO -->
					<div class="product-info">
						<a href="/{{$service->user->username}}/{{$link}}/{{$service->id}}">
							<p style="height:31px" class="text-header">{{$service->title}}</p>
						</a>
						
						<a href="/{{$service->user->username}}/{{$link}}/{{$service->id}}">
							<p class="category primary">{{$service->category->name}}</p>
						</a>
						<p class="price"><span>$</span>{{$service->packages->first()->price}}</p>
					</div>
					<!-- /PRODUCT INFO -->
					<hr class="line-separator">

					<!-- USER RATING -->
					<div class="user-rating">
						<a href="/{{$service->user->username}}">
							<figure class="user-avatar small">
								<img style="height: 26px; width: 26px;" src="image\{{$service->user->picLink}}" alt="user-avatar">
							</figure>
						</a>
						<a href="/{{$service->user->username}}">
							<p class="text-header tiny">{{$service->user->name}}</p>
						</a>
						<ul class="rating tooltip tooltipstered" title="User's Rating">
                            <?php $averageRating=$service->user->averageRating(); ?>
							<li class="rating-item @if($averageRating < 0.5 ) empty @endif">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
							<li class="rating-item @if($averageRating < 1.5 ) empty @endif">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
							<li class="rating-item @if($averageRating < 2.5 ) empty @endif">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
							<li class="rating-item @if($averageRating < 3.5 ) empty @endif">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
							<li class="rating-item @if($averageRating < 4.5 ) empty @endif">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
						</ul>
					</div>
					<!-- /USER RATING -->
				</div>
				<!-- /PRODUCT ITEM -->

            <?php $count++; ?>
			<!-- /PRODUCT LIST -->
				@endforeach
			</div>
		<!-- /PRODUCT SHOWCASE -->
		<div class="clearfix"></div>
		<!-- PRODUCT SHOWCASE -->
		<div class="product-showcase">
			<!-- HEADLINE -->
			<div class="headline primary">
				<h4>Top Rated Services</h4>
				<!-- SLIDE CONTROLS -->
				<div class="slide-control-wrap">
					
				</div>
				<!-- /SLIDE CONTROLS -->
				<!-- /HEADLINE -->
            <?php $count=4;?>
			@foreach($top as $service)
                <?php $link = preg_replace('/\s+/', '_', $service->title); ?>
				<!-- PRODUCT LIST -->
					@if($count%4==0)
			</div>
			<div class="clearfix"></div>
			<div id="pl-1" class="product-list grid column4-wrap">
			@endif
			<!-- PRODUCT ITEM -->
				<div class="product-item column">
					<!-- PRODUCT PREVIEW ACTIONS -->
					<div class="product-preview-actions">
						<!-- PRODUCT PREVIEW IMAGE -->
						<figure class="product-preview-image">
							<img  style="max-height: 300px; height: 100%;"  src="\image\{{$service->imgLink}}" alt="product-image">
						</figure>
						<!-- /PRODUCT PREVIEW IMAGE -->

						<!-- PREVIEW ACTIONS -->
						<div class="preview-actions">
							<!-- PREVIEW ACTION -->
							<div style="margin: auto !important; left:100px !important;" class="preview-action">
								<a href="/{{$service->user->username}}/{{$link}}/{{$service->id}}">
									<div class="circle tiny primary">
										<span class="icon-tag"></span>
									</div>
								</a>
								<a href="/{{$service->user->username}}/{{$link}}/{{$service->id}}">
									<p>Go to Item</p>
								</a>
							</div>
							<!-- /PREVIEW ACTION -->
						</div>
						<!-- /PREVIEW ACTIONS -->
					</div>
					<!-- /PRODUCT PREVIEW ACTIONS -->

					<!-- PRODUCT INFO -->
					<div class="product-info">
						<a href="/{{$service->user->username}}/{{$link}}/{{$service->id}}">
							<p style="height:31px" class="text-header">{{$service->title}}</p>
						</a>
						
						<a href="/{{$service->user->username}}/{{$link}}/{{$service->id}}">
							<p class="category primary">{{$service->category->name}}</p>
						</a>
						<p class="price"><span>$</span>{{$service->packages->first()->price}}</p>
					</div>
					<!-- /PRODUCT INFO -->
					<hr class="line-separator">

					<!-- USER RATING -->
					<div class="user-rating">
						<a href="/{{$service->user->username}}">
							<figure class="user-avatar small">
								<img style="height: 26px; width: 26px;" src="image\{{$service->user->picLink}}" alt="user-avatar">
							</figure>
						</a>
						<a href="/{{$service->user->username}}">
							<p class="text-header tiny">{{$service->user->name}}</p>
						</a>
						<ul class="rating tooltip tooltipstered" title="User's Rating">
                            <?php $averageRating=$service->user->averageRating(); ?>
							<li class="rating-item @if($averageRating < 0.5 ) empty @endif">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
							<li class="rating-item @if($averageRating < 1.5 ) empty @endif">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
							<li class="rating-item @if($averageRating < 2.5 ) empty @endif">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
							<li class="rating-item @if($averageRating < 3.5 ) empty @endif">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
							<li class="rating-item @if($averageRating < 4.5 ) empty @endif">
								<!-- SVG STAR -->
								<svg class="svg-star">
									<use xlink:href="#svg-star"></use>
								</svg>
								<!-- /SVG STAR -->
							</li>
						</ul>
					</div>
					<!-- /USER RATING -->
				</div>
				<!-- /PRODUCT ITEM -->

            <?php $count++; ?>
			<!-- /PRODUCT LIST -->
				@endforeach
			</div>

		</div>
		<!-- /PRODUCT SHOWCASE -->
		<div class="clearfix"></div>


	</div>
</div>
<!-- /PRODUCTS SIDESHOW -->


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


<!-- jQuery -->

<!-- Tooltipster -->
<script src="js\vendor\jquery.tooltipster.min.js"></script>
<!-- Owl Carousel -->
<script src="js\vendor\owl.carousel.min.js"></script>
<!-- Tweet -->
<!-- xmAlerts -->
<!-- Side Menu -->
<script src="js\side-menu.js"></script>
<!-- Home -->
<script src="js\home.js"></script>
<!-- Tooltip -->
<script src="js\tooltip.js"></script>
<!-- User Quickview Dropdown -->
<!-- Home Alerts -->
<script src="js\user-board.js"></script>

<!-- Footer -->
<script src="js\footer.js"></script>
<script>
    function selectt(nam){
        $('#categories').attr('name',nam);
        console.log(nam);
    }
</script>
</body>
</html>