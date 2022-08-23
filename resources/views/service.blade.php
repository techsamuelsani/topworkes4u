<?php
$package=$service->packages;
$count=count($package);
if(Auth::check()){
    $user=Auth::User();
}
$link = preg_replace('/\s+/', '_', $service->title);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="\css\vendor\simple-line-icons.css">
	<link rel="stylesheet" href="\css\vendor\tooltipster.css">
	<link rel="stylesheet" href="\css\vendor\owl.carousel.css">
	<link rel="stylesheet" href="\css\style.css">
	<script src="https://www.2checkout.com/static/checkout/javascript/direct.min.js"></script>
	<!-- favicon -->
	<link rel="icon" href="\image\favicon.ico">
	<title>Lancerr.net | {{$service->title}}</title>
</head>
<body>

	<!-- HEADER -->
	@include('header')
	<!-- /HEADER -->





	<!-- SECTION -->
	<div class="section-wrap">
		<div class="section">
			<!-- SIDEBAR -->
			<div class="sidebar right">
				<!-- SIDEBAR ITEM -->
				<div class="sidebar-item">
					<p class="price large"><span>$</span>{{$service->packages->first()->price}}</p>
					<hr class="line-separator">
					<form id="aux_form" name="aux_form"></form>

					<!-- CHECKBOX -->
					<input type="radio" id="standard" name="standard" form="aux_form" checked="">
					<label class="b-label linked-check" for="standard">
						<span class="checkbox primary"><span></span></span>
						Standard Package
					</label>
					<!-- /CHECKBOX -->
					<p class="license-text" data-license="standard" style="display: block;"><strong style="color:#00d7b3;">Number of days:{{$service->packages->first()->days}}</strong> <br /> <strong style="color:#1cbdf9;">Number of revisions:{{$service->packages->first()->revisions}}</strong> <br /> {{$service->packages->first()->detail}}</p>
 					@if($count>=2)
					<!-- CHECKBOX -->
					<input type="radio" id="premium" name="premium" form="aux_form">
					<label class="b-label linked-check" for="premium">
						<span class="checkbox primary"><span></span></span>
						Premium Package
					</label>
					<!-- /CHECKBOX -->
					<p class="license-text" data-license="premium"><strong style="color: #00d7b3;">Number of days:{{$package[1]->days}}</strong> <br /> <strong style="color:#1cbdf9;">Number of revisions:{{$package[1]->revisions}}</strong> <br /> {{$package[1]->detail}}</p>
                    @endif
					@if($count>=3)
					<!-- CHECKBOX -->
					<input type="radio" id="diamond" name="diamond" form="aux_form">
					<label class="b-label linked-check" for="diamond">
						<span class="checkbox primary"><span></span></span>
						Diamond Package
					</label>
					<!-- /CHECKBOX -->
					<p class="license-text" data-license="diamond"><strong style="color: #00d7b3;">Number of days:{{$package[2]->days}}</strong> <br /> <strong style="color:#1cbdf9;">Number of revisions:{{$package[2]->revisions}}</strong> <br /> {{$package[2]->detail}}</p>
					@endif
                    @if(Auth::Check())
					@if( $service->user->id != $user->id)
					<form action='https://sandbox.2checkout.com/checkout/purchase' method='post'>
						<input type='hidden' name='sid' value='901394469' />
						<input type='hidden' name='mode' value='2CO' />
						<input type='hidden' name='li_0_type' value='product' />
						<input type='hidden' id="idd"  name='li_0_name' value='p{{$service->packages->first()->id}}' />
						<input type='hidden' id="pprice" name='li_0_price' value='{{$service->packages->first()->price}}' />
						<input type='hidden' name='card_holder_name' value='{{$user->name}}' />
						<input type='hidden' name='street_address' value='{{$user->address}}' />
						<input type='hidden' name='city' value='{{$user->city}}' />
						<input type='hidden' name='state' value='{{$user->state}}' />
						<input type='hidden' name='zip' value='{{$user->zip}}' />
						<input type='hidden' name='country' value='{{$user->country}}' />
						<input type='hidden' name='email' value='{{$user->email}}' />
						<input type='hidden' name='phone' value='{{$user->phone}}' />
						<input name='submit' class="button mid dark spaced" type='submit' value='Purchase Now' />
					</form>
						@if($user->balance>0)
							<form method="post" action="{{$service->id}}/buy">
								@csrf
							<input type='hidden' id="idd"  name='li_0_name' value='p{{$service->packages->first()->id}}' />
							<input type="submit" class="button mid dark spaced" value="Buy with account Balance"  />
							</form>
						@endif
                    @elseif($service->user->id == $user->id)
                            <a name='submit' class="button mid dark spaced"  href="/{{$user->username}}/{{$link}}/{{$service->id}}/edit" />Edit Service</a>
                    @endif
					@else
						<a name='submit' class="button mid dark spaced" href="\login" />Login to buy</a>
					@endif

				</div>
				<!-- /SIDEBAR ITEM -->

				<!-- SIDEBAR ITEM -->
				<div class="sidebar-item author-bio">
					<h4>Service Seller</h4>
					<hr class="line-separator">
					<!-- USER AVATAR -->
					<a href="/{{$service->user->username}}" class="user-avatar-wrap medium">
						<figure class="user-avatar medium">
							<img style="width: 70px; height:70px;" src="\image\{{$service->user->picLink}}" alt="">
						</figure>
					</a>
					<!-- /USER AVATAR -->
					<p class="text-header">{{$service->user->name}}</p>
					<p class="text-oneline">{{$service->user->city}}, {{$service->user->country}}</p>
						<?php $averageRating=$service->user->averageRating(); ?>
					<ul style="display: block; margin: auto; width: 75px;" title="User's Rating" class="rating">
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
					<br />
					<a href="\{{$service->user->username}}" class="button mid dark spaced">Go to <span class="primary">Profile Page</span></a>
					@if(Auth::Check())
					@if( $service->user->id != $user->id)
					<a href="\{{$service->user->username}}\conversation" class="button mid dark-light">Send a Private Message</a>
					@endif
					@endif
				</div>
				<!-- /SIDEBAR ITEM -->

				<div class="sidebar-item author-reputation full">
					<h4>Seller's Reputation</h4>
					<hr class="line-separator">
					<!-- PIE CHART -->
					<div class="pie-chart pie-chart1">
						<p class="text-header percent">{{$averageRating*100/5}}<span>%</span></p>
						<p class="text-header percent-info">@if($averageRating>3) Recommended @else Not Recommended @endif</p>
						<!-- RATING -->
						<ul class="rating">
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
						<!-- /RATING -->
					</div>
					<!-- /PIE CHART -->
				</div>

				<!-- SIDEBAR ITEM -->
				<div class="sidebar-item product-info">
					<h4>Service Information</h4>
					<hr class="line-separator">
					<!-- INFORMATION LAYOUT -->
					<div class="information-layout">
						<!-- INFORMATION LAYOUT ITEM -->
						<div class="information-layout-item">
							<p class="text-header">Sales:</p>
							<p>{{count($service->orders())}}</p>
						</div>
						<!-- /INFORMATION LAYOUT ITEM -->

						<!-- INFORMATION LAYOUT ITEM -->
						<div class="information-layout-item">
							<p class="text-header">Upload Date:</p>
							<p>{{ date('F d, Y', strtotime($service->created_at)) }}</p>
						</div>
						<!-- /INFORMATION LAYOUT ITEM -->

						<!-- INFORMATION LAYOUT ITEM -->
						<div class="information-layout-item">
							<p class="text-header">Category:</p>
							<p>{{$service->category->name}}</p>
						</div>
						<!-- /INFORMATION LAYOUT ITEM -->


						<!-- /INFORMATION LAYOUT ITEM -->

						<!-- INFORMATION LAYOUT ITEM -->
						<div class="information-layout-item">
							<p class="tags primary"> @foreach($service->tags as $tag) <a href="\view\services\?search={{$tag->tag}}">{{$tag->tag}}</a>,@endforeach </p>
						</div>
						<!-- /INFORMATION LAYOUT ITEM -->
					</div>
					<!-- INFORMATION LAYOUT -->
				</div>
				<!-- /SIDEBAR ITEM -->


			</div>
			<!-- /SIDEBAR -->

			<!-- CONTENT -->
			<div class="content left">
				<!-- POST -->
				<article class="post">
					<!-- POST IMAGE -->
					<div class="post-image">
						<figure class="product-preview-image large">
							<img style="max-height: 500px; height: 100%" src="\image\{{$service->imgLink}}" alt="">
						</figure>
					</div>
					<!-- /POST IMAGE -->


					<hr class="line-separator">

					<!-- POST CONTENT -->
					<div class="post-content">
						<!-- POST PARAGRAPH -->
						<div class="post-paragraph">
							<h3 class="post-title">{{$service->title}}</h3>
                            <p>{{$service->details}}</p>
                        </div>

						<br /> <br />
						<!-- /POST PARAGRAPH -->

                        <div>
						<!-- POST PARAGRAPH -->
						<div style=" margin-top: 0px !important; float: left; height:100%; border-right:1px solid grey; padding:5px; margin-left: 10px; width: 250px;" class="post-paragraph">
							<h3 style="color:#1cbdf9;" class="post-title small">Standard Package</h3>
							<!-- POST ITEM LIST -->
							<ul class="post-item-list">
								<li>
									<!-- SVG CHECK -->
									<svg class="svg-check bullet-icon">
										<use xlink:href="#svg-check"></use>
									</svg>
									<!-- /SVG CHECK -->
									<p>Number of days: {{$service->packages->first()->days}}</p>
								</li>
								<li>
									<!-- SVG CHECK -->
									<svg class="svg-check bullet-icon">
										<use xlink:href="#svg-check"></use>
									</svg>
									<!-- /SVG CHECK -->
									<p>Number of Revisions: {{$service->packages->first()->revisions}}</p>
								</li>
								<li>
									<strong>Detail:</strong>
									<p>{{$service->packages->first()->detail}}</p>
								</li>
							</ul>
							<!-- POST ITEM LIST -->
						</div>
						<!-- /POST PARAGRAPH -->
						
						<!-- POST PARAGRAPH -->
						<div style="margin-top: 0px !important; margin-left: 10px; float: left; height:100%; border-right:1px solid grey; padding:5px; border-right:1px solid grey; width: 250px;" class="post-paragraph">
								<h3 style="color:#1cbdf9;" class="post-title small">Premium Package</h3>
								@if($count>=2)
								<!-- POST ITEM LIST -->
								<ul class="post-item-list">
									<li>
										<!-- SVG CHECK -->
										<svg class="svg-check bullet-icon">
											<use xlink:href="#svg-check"></use>
										</svg>
										<!-- /SVG CHECK -->
										<p>Number of days: {{$package[1]->days}}</p>
									</li>
									<li>
										<!-- SVG CHECK -->
										<svg class="svg-check bullet-icon">
											<use xlink:href="#svg-check"></use>
										</svg>
										<!-- /SVG CHECK -->
										<p>Number of Revisions: {{$package[1]->revisions}}</p>
									</li>
									<li>
										<strong>Detail:</strong>
										<p>{{$package[1]->detail}}</p>
									</li>
								</ul>
								<!-- POST ITEM LIST -->
								@endif
							</div>
						<!-- /POST PARAGRAPH -->
						
						
						<!-- POST PARAGRAPH -->
						<div style=" margin-top: 0px !important; margin-left: 10px; float: left; height:100%; padding:5px; width: 250px;" class="post-paragraph">
								<h3 style="color:#1cbdf9;"  class="post-title  small">Diamond Package</h3>
								@if($count>=3)
								<!-- POST ITEM LIST -->
								<ul class="post-item-list">
									<li>
										<!-- SVG CHECK -->
										<svg class="svg-check bullet-icon">
											<use xlink:href="#svg-check"></use>
										</svg>
										<!-- /SVG CHECK -->
										<p>Number of days: {{$package[2]->days}}</p>
									</li>
									<li>
										<!-- SVG CHECK -->
										<svg class="svg-check bullet-icon">
											<use xlink:href="#svg-check"></use>
										</svg>
										<!-- /SVG CHECK -->
										<p>Number of Revisions: {{$package[2]->revisions}}</p>
									</li>
									<li>
										<strong>Detail:</strong>
										<p>{{$package[2]->detail}}</p>
									</li>
								</ul>
								<!-- POST ITEM LIST -->
								@endif
							</div>
						<!-- /POST PARAGRAPH -->
						


                        </div>
						<div class="clearfix"></div>
                        <br />
                        @if(Auth::check() && Auth::id()==$service->user_id)
                        <a href="/{{$user->username}}/{{$link}}/{{$service->id}}/edit" style="width: 100%" class="button mid dark spaced">Edit Service</a>
                        @endif
					</div>
					<!-- /POST CONTENT -->

					<hr class="line-separator">

					<!-- SHARE -->
					<div class="share-links-wrap">
						<p class="text-header small">Share this:</p>
						<!-- SHARE LINKS -->
						<ul class="share-links hoverable">
							<li><a target="_blank" rel="noopener noreferrer" href="https://www.facebook.com/sharer/sharer.php?u=https%3A//lancerr.net/{{$service->user->username}}/{{$link}}/{{$service->id}}" class="fb"></a></li>
							<li><a target="_blank" rel="noopener noreferrer" href="https://twitter.com/home?status=https%3A//lancerr.net/{{$service->user->username}}/{{$link}}/{{$service->id}}" class="twt"></a></li>
					
							<li><a target="_blank" rel="noopener noreferrer" href="https://plus.google.com/share?url=https%3A//lancerr.net/{{$service->user->username}}/{{$link}}/{{$service->id}}" class="gplus"></a></li>
						</ul>
						<!-- /SHARE LINKS -->
					</div>
					<!-- /SHARE -->
				</article>
				<!-- /POST -->

				<!-- POST TAB -->
				<div class="post-tab">
					<!-- TAB HEADER -->
					<div class="tab-header primary">
						<!-- TAB ITEM -->
						<div style="width: 100%;" class="tab-item selected">
							<p class="text-header">Reviews on this service</p>
						</div>
						<!-- /TAB ITEM -->

					</div>
					<!-- /TAB HEADER -->

					<!-- TAB CONTENT -->
					<div class="tab-content void">
						<!-- COMMENTS -->
						<div class="comment-list">
							@foreach($service->orders() as $order)
							@if($order->review)
							<!-- COMMENT -->
							<div class="comment-wrap">
								<!-- USER AVATAR -->
								<a href="\{{$order->buyer->username}}">
									<figure class="user-avatar medium">
										<img style="width: 70px; height: 70px;" src="\image\{{$order->buyer->picLink}}" alt="">
									</figure>
								</a>
								<!-- /USER AVATAR -->
								<div class="comment">
									<p class="text-header">{{$order->buyer->name}}</p>

									<p class="timestamp">{{ date('F d, Y \a\t h:i a', strtotime($order->review->created_at)) }}</p>
									<ul class="report rating tooltip tooltipstered">
										<li class="rating-item @if($order->review->ratingAverage() < 0.5) empty @endif">
											<!-- SVG STAR -->
											<svg style="height: 20px; width: 20px;" class="svg-star">
												<use xlink:href="#svg-star"></use>
											</svg>
											<!-- /SVG STAR -->
										</li>
										<li class="rating-item @if($order->review->ratingAverage() < 1.5) empty @endif">
											<!-- SVG STAR -->
											<svg style="height: 20px; width: 20px;" class="svg-star">
												<use xlink:href="#svg-star"></use>
											</svg>
											<!-- /SVG STAR -->
										</li>
										<li class="rating-item @if($order->review->ratingAverage() < 2.5) empty @endif">
											<!-- SVG STAR -->
											<svg style="height: 20px; width: 20px;" class="svg-star">
												<use xlink:href="#svg-star"></use>
											</svg>
											<!-- /SVG STAR -->
										</li>
										<li class="rating-item @if($order->review->ratingAverage() < 3.5) empty @endif">
											<!-- SVG STAR -->
											<svg style="height: 20px; width: 20px;" class="svg-star">
												<use xlink:href="#svg-star"></use>
											</svg>
											<!-- /SVG STAR -->
										</li>
										<li class="rating-item @if($order->review->ratingAverage() < 4.5) empty @endif">
											<!-- SVG STAR -->
											<svg style="height: 20px; width: 20px;" class="svg-star">
												<use xlink:href="#svg-star"></use>
											</svg>
											<!-- /SVG STAR -->
										</li>
										<br>
										<center><p style="font-size: 16px;">{{$order->review->ratingAverage()}}</p></center>
									</ul>
									<p style="margin-right: 100px;">{{$order->review->comment}}</p>


								</div>
							</div>
							<!-- /COMMENT -->

							<!-- LINE SEPARATOR -->
							<hr class="line-separator">
							<!-- /LINE SEPARATOR -->
							@endif
							@endforeach

						</div>
						<!-- /COMMENTS -->
					</div>
					<!-- /TAB CONTENT -->

				</div>
				<!-- /POST TAB -->
			</div>
			<!-- CONTENT -->
		</div>
	</div>
	<!-- /SECTION -->

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

<!-- SVG CHECK -->
<svg style="display: none;">
	<symbol id="svg-check" viewbox="0 0 15 12" preserveaspectratio="xMinYMin meet">
		<polygon points="12.45,0.344 5.39,7.404 2.562,4.575 0.429,6.708 3.257,9.536 3.257,9.536
			5.379,11.657 14.571,2.465 "></polygon>
	</symbol>
</svg>
<!-- /SVG CHECK -->

<!-- ImgLiquid -->
<script src="\js\vendor\imgLiquid-min.js"></script>
<!-- XM Tab -->
<script src="\js\vendor\jquery.xmtab.min.js"></script>
<!-- Tweet -->
<script src="\js\vendor\owl.carousel.min.js"></script>
<script src="\js\home.js"></script>
<!-- Liquid -->
<script src="\js\liquid.js"></script>
<!-- Checkbox Link -->
<!-- Image Slides -->
<script src="\js\image-slides.js"></script>
<!-- Post Tab -->
<script src="\js\post-tab.js"></script>
<!-- XM Accordion -->
<script src="\js\vendor\jquery.xmaccordion.min.js"></script>

<!-- Item V1 -->
<script src="\js\item-v1.js"></script>

<script>
    (function($) {
        var $checkbox = $('.linked-check');

        $checkbox.on( 'click', deselectLinked );

        function deselectLinked() {
            var $this = $(this),
                selectedCheckboxID = $this.prop('for'),
                selectedCheckboxStatus = $("#"+selectedCheckboxID).prop('checked');
            showDescription(selectedCheckboxID);

            $checkbox.each(function() {
                var $this = $(this),
                    checkboxID = $this.prop('for'),
                    checkboxStatus = $("#"+checkboxID).prop('checked');

                if( "standard" == selectedCheckboxID ) {
                    deselect($("#premium"));
                    hideDescription("premium");
                    deselect($("#diamond"));
                    hideDescription("diamond");
                    changePrice("<span>$</span>{{$service->packages->first()->price}}");
                    $('#pprice').val({{$package[0]->price}});
                    $('#idd').val({{$package[0]->id}})
                }
                @if($count>=2)
                if( "premium" == selectedCheckboxID ) {
                    deselect($("#standard"));
                    hideDescription("standard");
                    deselect($("#diamond"));
                    hideDescription("diamond");
                    changePrice("<span>$</span>{{$package[1]->price}}");
                    $('#pprice').val({{$package[1]->price}});
                    $('#idd').val({{$package[1]->id}})
                }
                @endif
				@if($count>=3)
                if( "diamond" == selectedCheckboxID ) {
                    deselect($("#standard"));
                    hideDescription("standard");
                    deselect($("#premium"));
                    hideDescription("premium");
                    changePrice("<span>$</span>{{$package[2]->price}}");
                    $('#pprice').val({{$package[2]->price}});
                    $('#idd').val({{$package[2]->id}})
                }
                @endif

            });
        }

        function deselect(checkbox) {
            checkbox.prop('checked', false);
        }

        function showDescription(container) {
            $(".license-text[data-license='"+container+"']").slideDown();
        }

        function hideDescription(container) {
            $(".license-text[data-license='"+container+"']").slideUp();
        }

        function changePrice(price) {
            $('.sidebar-item .price.large').html(price);
        }
    })(jQuery);


    var myCallback = function(data) {
        console.log(JSON.stringify(data));
        // Example callback data
        // {"event_type":"checkout_loaded"}
        // {"event_type":"checkout_closed"}
    };
    (function() {
        inline_2Checkout.subscribe('checkout_loaded', myCallback);
        inline_2Checkout.subscribe('checkout_closed', myCallback);
    }());

</script>
	<script>
        (function($){
            $('.pie-chart1').xmpiechart({
                width: 176,
                height: 176,
                percent:{{$averageRating*100/5}} ,
                fillWidth: 8,
                gradient: true,
                gradientColors: ['#10fac0', '#1cbdf9'],
                speed: 2,
                outline: true,
                linkPercent: '.percent'
            });
        })(jQuery);
	</script>
</body>
</html>