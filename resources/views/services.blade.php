<?php use Illuminate\Http\Request;
if(isset($_GET['range'])){
$string = $_GET['range'];
$result = explode(",", $string, 2);
}else{
$result[0]=0;
$result[1]=999;
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="\css\vendor\simple-line-icons.css">
	<link rel="stylesheet" href="\css\vendor\tooltipster.css">
	<link rel="stylesheet" href="\css\vendor\jquery.range.css">
	<link rel="stylesheet" href="\css\style.css">
	<!-- favicon -->
	<link rel="icon" href="\image\favicon.ico">
	<title>Lancer</title>
</head>
<body>

	<!-- HEADER -->
	@include('header')
	<!-- /HEADER -->


	<!-- SECTION -->
	<div class="section-wrap">
		<div class="section">
			<!-- CONTENT -->
			<div class="content">
				<!-- HEADLINE -->
				<div class="headline primary">
					<h4>{{$count}} Services Found &nbsp;&nbsp;@if(request()->search)<small style="color:#5e5e5e;" > for search: "{{request()->search}}"</small> @endif</h4>
				</div>
				<!-- /HEADLINE -->

				<!-- PRODUCT SHOWCASE -->
				<div class="product-showcase">
					<!-- PRODUCT LIST -->
					<div class="product-list list">
                        @foreach($services as $service)
                        <?php $link = preg_replace('/\s+/', '_', $service->title); ?>
                            <!-- PRODUCT ITEM -->
						<div class="product-item">
							<a href="\{{$service->user->username}}\{{$link}}\{{$service->id}}">
								<!-- PRODUCT PREVIEW IMAGE -->
								<figure class="product-preview-image small">
									<img style="height: 70px; width: 70px;" src="\image\{{$service->imgLink}}" alt="product-image">
								</figure>
								<!-- /PRODUCT PREVIEW IMAGE -->
							</a>

							<!-- PRODUCT INFO -->
							<div style="width: 45%;" class="product-info">
								<a href="\{{$service->user->username}}\{{$link}}\{{$service->id}}">
									<p class="text-header">{{$service->title}}</p>
								</a>
								<p style="max-height: 25px; font-size: 10px; line-height: 12px; overflow:hidden; " class="product-description">{{$service->details}}</p>
								<a>
									<p class="category primary">{{$service->category->name}}</p>
								</a>
							</div>
							<!-- /PRODUCT INFO -->

							<!-- AUTHOR DATA -->
							<div class="author-data">
								<!-- USER RATING -->
								<div class="user-rating">
									<a href="\{{$service->user->username}}">
										<figure class="user-avatar small">
											<img style="width: 26px;height: 26px;" src="\image\{{$service->user->picLink}}" alt="user-avatar">
										</figure>
									</a>
									<a href="\{{$service->user->username}}">
										<p class="text-header tiny">{{$service->user->name}}</p>
									</a>
								</div>
								<!-- /USER RATING -->

								<!-- METADATA -->
								<div class="metadata">
									<!-- META ITEM -->
									<div class="meta-item">
										<span class="icon-basket-loaded"></span>
										<p>{{count($service->orders())}}</p>
									</div>
									<!-- /META ITEM -->

									<!-- META ITEM -->
									<div class="meta-item">
										<span class="icon-eye"></span>
										<p>{{$service->views}}</p>
									</div>
									<!-- /META ITEM -->

								</div>
								<!-- /METADATA -->
							</div>
							<!-- /AUTHOR DATA -->

							<!-- AUTHOR DATA REPUTATION -->
							<div class="author-data-reputation">
								<p class="text-header tiny">Reputation</p>
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
							<!-- /AUTHOR DATA REPUTATION -->


							<!-- PRICE INFO -->
							<div class="price-info">
								<p class="price medium"><span>$</span>{{$service->packages->first()->price}}</p>
							</div>
							<!-- /PRICE INFO -->
						</div>
						<!-- /PRODUCT ITEM -->
                        @endforeach
					</div>
					<!-- /PRODUCT LIST -->
					<div class="clearfix"></div>
				</div>
				<!-- /PRODUCT SHOWCASE -->

				<!-- PAGER -->
				<div class="pager primary">

					@if($page>1)
					<a href="services/<?php echo ($page/1)-1; ?>/{{$parameters}}" style="height: 40px; width: 70px; font-size: 24px; padding-top: 5px;" class="pager-item"><p>Prev</p></a>
					@endif
					<?php if(($count/10)>($page/1)){ ?>
						<a href="services/<?php echo ($page/1)+1; ?>/{{$parameters}}" style="height: 40px; width: 70px; font-size: 24px; padding-top: 5px;" class="pager-item"><p>Next</p></a>
					<?php } ?>
				</div>
				<!-- /PAGER -->
			</div>
			<!-- SHOP CONTENT -->

			<!-- SIDEBAR -->
			<div class="sidebar">

				<!-- SIDEBAR ITEM -->
				<div class="sidebar-item">
					<h4>Filter Category</h4>
					<hr class="line-separator">
					<form id="shop_search_form"  name="shop_search_form">
                        <?php if(isset($_GET['search'])){ ?>
						<input type="hidden" name="search" value="<?php echo $_GET['search'] ?>" >
                        <?php } ?>
						<?php $cats=App\Category::all();   ?>
						@foreach($cats as $cat)
						<?php $name = preg_replace('/\s+/', '_', $cat->name);  ?>
						<!-- CHECKBOX -->

						<input type="checkbox" id="{{$name}}" name="{{$name}}" <?php if(count(request()->all())){ if(request()->$name){ echo 'checked=""'; } }else{ echo 'checked=""'; } ?>>
							<label for="{{$name}}">
							<span class="checkbox primary"><span></span></span>
							{{$cat->name}}
							<span class="quantity">{{count($cat->services->where('isVerified',1))}}</span>
						</label>
						<!-- /CHECKBOX -->
						@endforeach

					</form>
				</div>
				<!-- /SIDEBAR ITEM -->

				<!-- SIDEBAR ITEM -->
				<div class="sidebar-item">
					<h4>Filter Seller</h4>
					<hr class="line-separator">
					<!-- CHECKBOX -->
					<input type="checkbox" id="online" name="online" <?php if(count(request()->all())){ if(request()->online){ echo 'checked=""'; } }?> form="shop_search_form">
					<label for="online">
						<span class="checkbox primary"><span></span></span>
						Online Seller
						<span class="quantity"></span>
					</label>
					<!-- /CHECKBOX -->

					<!-- CHECKBOX -->
					<input type="checkbox" id="rating" name="rating" <?php if(count(request()->all())){ if(request()->rating){ echo 'checked=""'; } }?> form="shop_search_form" >
					<label for="rating">
						<span class="checkbox primary"><span></span></span>
						High Rating Seller
						<span class="quantity"></span>
					</label>
					<!-- /CHECKBOX -->


				</div>
				<!-- /SIDEBAR ITEM -->

				<!-- SIDEBAR ITEM -->
				<div class="sidebar-item range-feature">
					<h4>Price Range</h4>
					<hr class="line-separator spaced">
					<input type="hidden" name="range" class="price-range-slider" value="{{$result[1]}}" min="5" max="999"   form="shop_search_form">
					<button form="shop_search_form" class="button mid primary">Update your Search</button>
				</div>
				<!-- /SIDEBAR ITEM -->
			</div>
			<!-- /SIDEBAR -->
		</div>
	</div>
	<!-- /SECTION -->

	<!-- FOOTER -->
	@include('footer');
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

<!-- JRange -->
<script src="\js\vendor\jquery.range.min.js"></script>


<script>
    (function($) {
        /*-----------
            RANGE
        -----------*/
        $('.price-range-slider').jRange({
            from: 5,
            to: 999,
            step: 1,
            format: '$%s',
            width: 242,
            showLabels: true,
            showScale: true,
            isRange : true,
            theme: "theme-edragon"
        });
    })(jQuery);
</script>
</body>
</html>