<?php $user=Auth::User(); $services=$user->services; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="css\vendor\simple-line-icons.css">
	<link rel="stylesheet" href="css\vendor\tooltipster.css">
	<link rel="stylesheet" href="css\vendor\jquery.range.css">
	<link rel="stylesheet" href="css\style.css">
	<link rel="stylesheet" href="css\vendor\magnific-popup.css">
	<!-- favicon -->
	<link rel="icon" href="\image\favicon.ico">
	<title>Lancerr | Jobs</title>
</head>
<body>

	<!-- HEADER -->
	@include('header')
	<!-- /HEADER -->

<div id="pop" style="display: none;">
	<div class="mfp-bg mfp-fade mfp-ready"></div>
	<div class="mfp-wrap mfp-close-btn-in mfp-auto-cursor mfp-fade mfp-ready" tabindex="-1" style="overflow-x: hidden; overflow-y: auto;"><div class="mfp-container mfp-s-ready mfp-inline-holder"><div class="mfp-content"><div id="new-message-popup" class="form-popup new-message">
					<!-- FORM POPUP CONTENT -->
					<div class="form-popup-content">
						<h4 class="popup-title">Send Offer &nbsp; &nbsp; &nbsp;<small id="title"></small></h4>
						<!-- LINE SEPARATOR -->
						<hr class="line-separator">
						<!-- /LINE SEPARATOR -->
						<form method="post" action="" class="new-message-form">
							@csrf
								<input id="job_id" type="hidden" value="" name="job_id">
							<!-- INPUT CONTAINER -->
							<div style="float: left; width: 50%; padding: 5px;" class="input-container field-add">
								<label for="service" class="rl-label b-label required">Service:</label>
								<label for="service" class="select-block">
									<select name="service_id" id="service_id">
                                        @foreach($services as $service)
										<option value="{{$service->id}}">{{$service->title}}</option>
                                        @endforeach
									</select>
									<!-- SVG ARROW -->
									<svg class="svg-arrow">
										<use xlink:href="#svg-arrow"></use>
									</svg>
									<!-- /SVG ARROW -->
								</label>
							</div>
							<!-- /INPUT CONTAINER -->
							<div style="float: left; width: 50%; padding: 5px;" class="input-container">
								<label for="price" class="rl-label required">Price</label>
								<input type="number" id="price" required name="price" placeholder="Enter price...">
							</div>
							<div class="clearfix"></div>
							<div style="float: left; width: 50%; padding: 5px;" class="input-container">
								<label for="price" class="rl-label required">Revisions</label>
								<input type="number" id="revisions" required name="revisions" placeholder="Enter revisions...">
							</div>
							<div style="float: left; width: 50%; padding: 5px;" class="input-container">
								<label for="days" class="rl-label required">Days</label>
								<input type="number" id="days" name="days" placeholder="Enter number of days...">
							</div>
							<div class="clearfix"></div>
							<!-- INPUT CONTAINER -->
							<div class="input-container">
								<label for="message" class="rl-label b-label required">Your quote:</label>
								<textarea style="height: auto;" id="quote" name="quote" placeholder="Write your quote here..."></textarea>
							</div>
							<!-- INPUT CONTAINER -->

							<button class="button mid dark">Send <span class="primary">Offer</span></button>
						</form>
					</div>
					<!-- /FORM POPUP CONTENT -->
					<a onclick="cclose()" class="close-btn mfp-close"><span style="color: white; position: absolute; left: 10px;">X</span></a>
				</div></div></div></div>
</div>

	<!-- SECTION -->
	<div class="section-wrap">
		<div class="section">
			<!-- CONTENT -->
			<div style="width:100%;" class="content">
				<!-- HEADLINE -->
				<div class="headline primary">
					<h4>{{count($jobs)}} Jobs Found</h4>
					<div class="clearfix"></div>
				</div>
				<!-- /HEADLINE -->

				<!-- PRODUCT SHOWCASE -->
				<div class="product-showcase">
					<!-- PRODUCT LIST -->
					<div style="width:100%;" class="product-list list">
						@foreach($jobs as $job)

                        @if(!count($job->offers()->where('user_id',$user->id)->get()))
						<!-- PRODUCT ITEM -->
						<div style="padding: 5px !important; padding-left: 15px !important; height:105px;" class="product-item">
							<!-- PRODUCT INFO -->
							<div style="width: 450px; height: auto !important;" class="product-info">
								<a href="item-v1.html">
									<p class="text-header">{{$job->title}}</p>
								</a>
								<p class="product-description">{{$job->details}}</p>
								<p class="product-description">{{$job->requirements}}</p>
								<a href="shop-gridview-v1.html">
									<p class="category primary">{{$job->category->name}}</p>
								</a>
							</div>
							<!-- /PRODUCT INFO -->

							<!-- AUTHOR DATA -->
							<div class="author-data">
								<!-- USER RATING -->
								<div class="user-rating">
									<a href="/{{$job->user->username}}">
										<figure class="user-avatar small">
											<img style="width: 26px; height: 26px;" src="image\{{$job->user->picLink}}" alt="user-avatar">
										</figure>
									</a>
									<a href="author-profile.html">
										<p class="text-header tiny">{{$job->user->name}}</p>
									</a>
								</div>
								<!-- /USER RATING -->

								<!-- METADATA -->
								<div class="metadata">
									<!-- META ITEM -->
									<div class="meta-item">
										<span class="icon-envelope"></span>
										<p>{{count($job->offers)}}</p>
									</div>
									<!-- /META ITEM -->

									<!-- META ITEM -->
									<div class="meta-item">
										<span class="icon-handbag"></span>
										<p>{{count($job->user->buyings)}}</p>
									</div>
									<!-- /META ITEM -->

								</div>
								<!-- /METADATA -->
							</div>
							<!-- /AUTHOR DATA -->


							<!-- ITEM ACTIONS -->
							<div class="item-actions">
								<a onclick="show('{{$job->title}}',{{$job->id}})" class="tooltip" title="Send Offer">
									<div style="background-color:#1cbdf9;" class="circle tiny">
										<span style="font-size: 25px; position: absolute; top: 8px; left: 8px;" class="icon-envelope"></span>
									</div>
								</a>
							</div>
							<!-- /ITEM ACTIONS -->

							<!-- PRICE INFO -->
							<div class="price-info">
								<p class="price medium"><span>$</span>{{$job->budget}}</p>
							</div>
							<!-- /PRICE INFO -->
						</div>
						<!-- /PRODUCT ITEM -->
                        @endif
					@endforeach

					</div>
					<!-- /PRODUCT LIST -->
					<div class="clearfix"></div>
				</div>
				<!-- /PRODUCT SHOWCASE -->

			</div>
			<!-- SHOP CONTENT -->
		</div>
	</div>
	<!-- /SECTION -->

	<!-- FOOTER -->
	@include('footer');
	<!-- /FOOTER -->

	<div class="shadow-film closed"></div>



<!-- jQuery -->

<!-- JRange -->
<script src="js\vendor\jquery.range.min.js"></script>
<!-- Tooltipster -->

<!-- Shop -->
<script src="js\shop.js"></script>

<script>
	function show(title,id){
	    $('#title').text(title);
	    $('#job_id').val(id);
		$('#pop').show();
	}

    function cclose(){
        $('#pop').hide();
    }
</script>
</body>
</html>