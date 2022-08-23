<?php $averageRating=$user->averageRating();
$userr=null;
if(Auth::check()){
$userr=Auth::user();
}
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="\css\vendor\simple-line-icons.css">
	<link rel="stylesheet" href="\css\vendor\tooltipster.css">
	<link rel="stylesheet" href="\css\style.css">
	<!-- favicon -->
	<link rel="icon" href="\image\favicon.ico">
	<title>{{$user->name}} Lancerr.net</title>
</head>
<body>

	<!-- HEADER -->
	@include('header')
	<!-- /HEADER -->


	<!-- AUTHOR PROFILE BANNER -->
	<div class="author-profile-banner"></div>
	<!-- /AUTHOR PROFILE BANNER -->

	<!-- AUTHOR PROFILE META -->
	<div class="author-profile-meta-wrap">
		<div class="author-profile-meta">
			<!-- AUTHOR PROFILE INFO -->
			<div class="author-profile-info">
				<!-- AUTHOR PROFILE INFO ITEM -->
				<div class="author-profile-info-item">
					<p class="text-header">Member Since:</p>
					<p>{{ date('F d, Y', strtotime($user->created_at)) }}</p>
				</div>
				<!-- /AUTHOR PROFILE INFO ITEM -->

				<!-- AUTHOR PROFILE INFO ITEM -->
				<div class="author-profile-info-item">
					<p class="text-header">Total Sales:</p>
					<p>{{count($user->sellings())}}</p>
				</div>
				<!-- /AUTHOR PROFILE INFO ITEM -->

				<!-- AUTHOR PROFILE INFO ITEM -->
				<div class="author-profile-info-item">
					<p class="text-header">Freelance Work:</p>
					<p>@if($user->type!="seller") Not Available @else Available @endif</p>
				</div>
				<!-- /AUTHOR PROFILE INFO ITEM -->

				<!-- AUTHOR PROFILE INFO ITEM -->
				<div class="author-profile-info-item">
					<p class="text-header">Last Seen:</p>
					<p>{{ date('F d, Y \a\t h:i a', strtotime($user->lastOnline)) }}</p>
				</div>
				<!-- /AUTHOR PROFILE INFO ITEM -->
			</div>
			<!-- /AUTHOR PROFILE INFO -->
		</div>
	</div>
	<!-- /AUTHOR PROFILE META -->

	<!-- SECTION -->
	<div class="section-wrap">
		<div class="section overflowable">
			<!-- SIDEBAR -->
			<div class="sidebar left author-profile">
				<!-- SIDEBAR ITEM -->
				<div class="sidebar-item author-bio">
					<!-- USER AVATAR -->
					<a href="" class="user-avatar-wrap medium">
						<figure class="user-avatar medium">
							<img style="width: 70px; height: 70px;" src="\image\{{$user->picLink}}" alt="{{$user->username}}">
						</figure>
					</a>
					<!-- /USER AVATAR -->
					<p class="text-header">{{$user->name}}</p>
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
					@if($user->isOnline())
					<p style="color:#00d7b3;" class="text-oneline">Online</p>
					@else
						<p style="color:#f42a50;" class="text-oneline">Offline</p>
					@endif
					<p class="text-oneline">Pakistan</p>
					@if($userr->id==$user->id)
					<a href="/{{$user->username}}/settings" class="button mid dark-light">Edit Profile</a>
					@else
					<a href="/{{$user->username}}/conversation" class="button mid dark-light">Send a Private Message</a>
					@endif
				</div>
				<!-- /SIDEBAR ITEM -->


				<!-- SIDEBAR ITEM -->
				<div class="sidebar-item author-reputation full">
					<h4>User's Reputation</h4>
					<hr class="line-separator">
					<!-- PIE CHART -->
					<div class="pie-chart pie-chart1">
						<p class="text-header percent">{{round($averageRating*100/5,2)}}<span>%</span></p>
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
					<a href="#reviews" class="button mid dark-light">Read all the Customer Reviews</a>
				</div>
				<!-- /SIDEBAR ITEM -->
			</div>
			<!-- /SIDEBAR -->

			<!-- CONTENT -->
			<div class="content right">
				<!-- HEADLINE -->
				<div class="headline buttons primary">
					<h4>User's Services</h4>
				</div>
				<!-- /HEADLINE -->

				<!-- PRODUCT LIST -->
				<div class="product-list grid column3-4-wrap">
					<?php $services=$user->services; ?>
						@foreach($services as $service)
                            <?php $link = preg_replace('/\s+/', '_', $service->title); ?>
					<!-- PRODUCT ITEM -->
					<div class="product-item column">
						<!-- PRODUCT PREVIEW ACTIONS -->
						<div class="product-preview-actions">
							<!-- PRODUCT PREVIEW IMAGE -->
							<figure class="product-preview-image">
								<img style="max-height: 300px; height: 100%;" src="\image\{{$service->imgLink}}" alt="product-image">
							</figure>
							<!-- /PRODUCT PREVIEW IMAGE -->

							<!-- PREVIEW ACTIONS -->
							<div class="preview-actions">
								<!-- PREVIEW ACTION -->
								<div class="preview-action" style="margin: auto !important; left:100px !important;" >
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
								<p style='height:31px;' class="text-header">{{$service->title}}</p>
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
							<a href="\{{$user->username}}">
								<figure class="user-avatar small">
									<img src="\image\{{$user->picLink}}" alt="user-avatar">
								</figure>
							</a>
							<a href="\{{$user->username}}">
								<p class="text-header tiny">{{$user->name}}</p>
							</a>
							<ul class="rating" title="User's Rating">
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
						@endforeach

				</div>
				<!-- /PRODUCT LIST -->

				<div class="clearfix"></div>

				<!-- HEADLINE -->
				<div class="headline buttons primary">
					<h4>Average Skill Ratings</h4>
				</div>
				<!-- /HEADLINE -->

				<!-- COMMENTS -->
				<div class="comment-list">
					@foreach($user->averageSkills() as $avgSkill)
						<?php $skill=App\Skill::find($avgSkill->skill_id); ?>
					<!-- COMMENT -->
					<div style="padding: 16px 16px 0 10px;" class="comment-wrap">
						<!-- /USER AVATAR -->
						<div class="comment">
							<p class="text-header">Skill: <span style="color:#03f1b6">{{$skill->name}}</span> </p>
							<ul class="report rating tooltip tooltipstered">
								<li  class="rating-item @if($avgSkill->average < 0.5) empty @endif">
									<!-- SVG STAR -->
									<svg style="height: 30px; width: 30px;" class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
								<li class="rating-item @if($avgSkill->average < 1.5) empty @endif">
									<!-- SVG STAR -->
									<svg style="height: 30px; width: 30px;" class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
								<li class="rating-item @if($avgSkill->average < 2.5) empty @endif">
									<!-- SVG STAR -->
									<svg style="height: 30px; width: 30px;" class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
								<li class="rating-item @if($avgSkill->average < 3.5) empty @endif">
									<!-- SVG STAR -->
									<svg style="height: 30px; width: 30px;" class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
								<li class="rating-item @if($avgSkill->average < 4.5) empty @endif">
									<!-- SVG STAR -->
									<svg style="height: 30px; width: 30px;" class="svg-star">
										<use xlink:href="#svg-star"></use>
									</svg>
									<!-- /SVG STAR -->
								</li>
								<br>
								<center><p style="font-size: 16px;">{{$avgSkill->average}}</p></center>
							</ul>
							<p style="margin-right: 200px;">This seller has <span style="color: #0b0b0b;">{{$avgSkill->average}}</span> average rating in skill <span style="color: #0b0b0b;"> {{$skill->name}}</span> with <span style="color: #0b0b0b;"> {{$avgSkill->total}}</span> reviews</p>
						</div>
					</div>
					<!-- /COMMENT -->

					<!-- LINE SEPARATOR -->
					<hr class="line-separator">
					<!-- /LINE SEPARATOR -->
					@endforeach
				</div>
				<!-- /COMMENTS -->
				<br /><br />
				<!-- HEADLINE -->
				<div class="headline buttons primary">
					<h4 id="reviews">Reviews</h4>
				</div>
				<!-- /HEADLINE -->

				<!-- COMMENTS -->
				<div class="comment-list">
				@foreach($user->reviews() as $review)
						<!-- COMMENT -->
							<div class="comment-wrap">
								<!-- USER AVATAR -->
								<a href="\{{$review->order->buyer->username}}">
									<figure class="user-avatar medium">
										<img style="width: 70px; height: 70px;" src="\image\{{$review->order->buyer->picLink}}" alt="">
									</figure>
								</a>
								<!-- /USER AVATAR -->
								<div class="comment">
									<p class="text-header">{{$review->order->buyer->name}}</p>

									<p class="timestamp">{{ date('F d, Y \a\t h:i a', strtotime($review->created_at)) }}</p>
									<ul class="report rating tooltip tooltipstered">
										<li class="rating-item @if($review->ratingAverage() < 0.5) empty @endif">
											<!-- SVG STAR -->
											<svg style="height: 20px; width: 20px;" class="svg-star">
												<use xlink:href="#svg-star"></use>
											</svg>
											<!-- /SVG STAR -->
										</li>
										<li class="rating-item @if($review->ratingAverage() < 1.5) empty @endif">
											<!-- SVG STAR -->
											<svg style="height: 20px; width: 20px;" class="svg-star">
												<use xlink:href="#svg-star"></use>
											</svg>
											<!-- /SVG STAR -->
										</li>
										<li class="rating-item @if($review->ratingAverage() < 2.5) empty @endif">
											<!-- SVG STAR -->
											<svg style="height: 20px; width: 20px;" class="svg-star">
												<use xlink:href="#svg-star"></use>
											</svg>
											<!-- /SVG STAR -->
										</li>
										<li class="rating-item @if($review->ratingAverage() < 3.5) empty @endif">
											<!-- SVG STAR -->
											<svg style="height: 20px; width: 20px;" class="svg-star">
												<use xlink:href="#svg-star"></use>
											</svg>
											<!-- /SVG STAR -->
										</li>
										<li class="rating-item @if($review->ratingAverage() < 4.5) empty @endif">
											<!-- SVG STAR -->
											<svg style="height: 20px; width: 20px;" class="svg-star">
												<use xlink:href="#svg-star"></use>
											</svg>
											<!-- /SVG STAR -->
										</li>
										<br>
										<center><p style="font-size: 16px;">{{$review->ratingAverage()}}</p></center>
									</ul>
									<p style="margin-right: 100px;">{{$review->comment}}</p>


								</div>
							</div>
							<!-- /COMMENT -->

							<!-- LINE SEPARATOR -->
							<hr class="line-separator">
							<!-- /LINE SEPARATOR -->
					@endforeach
				</div>
				<!-- /COMMENTS -->
			</div>
			<!-- CONTENT -->

			<div class="clearfix"></div>
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

<script>
    (function($){
        $('.pie-chart1').xmpiechart({
            width: 176,
            height: 176,
            percent:{{round($averageRating*100/5,2)}} ,
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