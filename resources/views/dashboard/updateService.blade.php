<?php
$cats=\App\Category::all();
$package=$service->packages;
$count=count($package);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="\css\vendor\simple-line-icons.css">
	<link rel="stylesheet" href="\css\style.css">
	<!-- favicon -->
	<link rel="icon" href="\image\favicon.ico">
	<title>Lancerr.net | Dashboard</title>
	<style>
		.upload-btn-wrapper {
			position: relative;
			overflow: hidden;
			display: inline-block;
			width: 200%;
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
			font-size: 100px;
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

	@include('dashboard.side')

    <!-- DASHBOARD BODY -->
    <div class="dashboard-body">
        <!-- DASHBOARD HEADER -->
        @include('dashboard.header')
        <!-- DASHBOARD HEADER -->

        <!-- DASHBOARD CONTENT -->
        <div class="dashboard-content" style="padding-top: 0px !important;">
            <!-- HEADLINE -->
            <div class="headline simple primary">
                <h4>Update Service</h4>
            </div>
            <!-- /HEADLINE -->


			<!-- FORM BOX ITEMS -->
			<div style="width:100%;" class="form-box-items wrap-3-1 left">
				<!-- FORM BOX ITEM -->
				<div class="form-box-item full">
					<h4>Service Specifications</h4>
					<hr class="line-separator">
					@foreach($errors->all() as $error)
					 <lable class="error">*{{$error}}</lable><br/>
					@endforeach
					<br />
					<form id="upload_form" enctype="multipart/form-data"  method="POST" action="">
						@csrf
						<!-- INPUT CONTAINER -->
						<div class="input-container">
							<label for="item_name" class="rl-label required">Service Title</label>
							<input type="text" id="item_name" value="{{$service->title}}" name="title" placeholder="Enter them service title here...">
						</div>
						<!-- /INPUT CONTAINER -->

						<!-- INPUT CONTAINER -->
						<div class="input-container half">
							<label for="category" class="rl-label required">Select Category</label>
							<label for="category" class="select-block">
								<select value="{{$service->category_id}}" name="categoryId" id="category">
									@foreach ($cats as $cat)
										<option value="{{ $cat->id }}">{{$cat->name}}</option>
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
						<!-- INPUT CONTAINER -->
						<div class="input-container half">
							<label for="item_tags" class="rl-label required">Search Tags</label>
							<input type="text" id="item_tags" value="@foreach($service->tags as $tag){{$tag->tag}},@endforeach" name="tags" placeholder="Enter search tags separated by a comma (Max 5)...">
						</div>
						<!-- /INPUT CONTAINER -->


						<!-- INPUT CONTAINER -->
						<div class="input-container">
							<label for="item_description" class="rl-label required">Service Description</label>
							<textarea id="item_description" name="details" placeholder="Enter them service description here...">{{$service->details}}</textarea>
						</div>
						<!-- /INPUT CONTAINER -->

                            <hr class="line-separator">
                            <button class="button big dark">Submit Updates <span class="primary">for Review</span></button>
                        </form>
                    <br/><br/>
                        <form id="upload_form" enctype="multipart/form-data"  method="POST" action="edit/image">
                           @csrf
                            <!-- INPUT CONTAINER -->
                            <div class="input-container">
                                <label class="rl-label required">Update Main Image</label>
								<center><img style="max-height: 150px; margin: auto;" src="/image/{{$service->imgLink}}"></center>
                                <!-- UPLOAD FILE -->
                                <div class="upload-file">
                                    <div class="upload-file-actions">
                                        <div class="upload-btn-wrapper">
                                            <button class="upbtn big">Select Image</button>
                                            <input type="file" name="image" />
                                        </div>
                                    </div>

                                </div>
                                <!-- UPLOAD FILE -->
                            </div>
                            <!-- /INPUT CONTAINER -->
							<button class="button big primary">Update Image</button>
                        </form>
						<hr class="line-separator">

                        <form id="upload_form" enctype="multipart/form-data"  method="POST" action="edit/package/1">
							@csrf
						<h4>Standard Package Details</h4>
						<hr class="line-separator">


						<!-- INPUT CONTAINER -->
						<div class="input-container half">
							<label for="files_included" class="rl-label required">Price</label>
							<input type="text" value="{{$service->packages->first()->price}}" id="files_included" name="price" placeholder="Enter price here...">
						</div>
						<!-- /INPUT CONTAINER -->

						<!-- INPUT CONTAINER -->
						<div class="input-container half">
							<label for="item_dimensions" class="rl-label required">Available Revisions</label>
							<input type="text" value="{{$service->packages->first()->revisions}}" id="item_dimensions" name="revisions" placeholder="Enter available revisions here...">
						</div>
						<!-- /INPUT CONTAINER -->

						<div class="clearfix"></div>

						<!-- INPUT CONTAINER -->
						<div class="input-container">
							<label for="sv" class="rl-label required">In Days</label>
							<input type="text" value="{{$service->packages->first()->days}}" id="days" name="days" placeholder="Enter days here...">

						</div>
						<!-- /INPUT CONTAINER -->



						<!-- INPUT CONTAINER -->
						<div class="input-container">
							<label for="item_description" class="rl-label required">Package Description</label>
							<textarea id="item_description" name="detail" placeholder="Enter them package description here...">{{$service->packages->first()->detail}}</textarea>
						</div>
						<!-- /INPUT CONTAINER -->

						<hr class="line-separator">
						<button class="button big dark">Submit Item <span class="primary">for Review</span></button>
					</form>
						<br/>
                        <form id="upload_form" enctype="multipart/form-data"  method="POST" action="edit/package/2">
							@csrf
                        <h4>Premium Package Details @if($count<2)<small> (you have not added it yet)</small>@endif</h4>
                        <hr class="line-separator">


                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="files_included" class="rl-label required">Price</label>
                            <input type="text" id="files_included" @if($count>=2) value="{{$package[1]->price}}" @endif name="price" placeholder="Enter price here...">
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <!-- INPUT CONTAINER -->
                        <div class="input-container half">
                            <label for="item_dimensions" class="rl-label required">Available Revisions</label>
                            <input type="text" id="item_dimensions" @if($count>=2) value="{{$package[1]->revisions}}" @endif name="revisions" placeholder="Enter available revisions here...">
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <div class="clearfix"></div>

                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="sv" class="rl-label required">In Days</label>
                            <input type="text" id="days" @if($count>=2) value="{{$package[1]->days}}" @endif name="days" placeholder="Enter days here...">

                        </div>
                        <!-- /INPUT CONTAINER -->



                        <!-- INPUT CONTAINER -->
                        <div class="input-container">
                            <label for="item_description" class="rl-label required">Package Description</label>
                            <textarea id="item_description" name="detail" placeholder="Enter them package description here...">@if($count>=2){{$package[1]->detail}}@endif</textarea>
                        </div>
                        <!-- /INPUT CONTAINER -->

                        <hr class="line-separator">
                        <button class="button big dark">Submit Item <span class="primary">for Review</span></button>
                    </form>
						<br/>
						<form id="upload_form" enctype="multipart/form-data"  method="POST" action="edit/package/3">
							@csrf
						<h4>Diamond Package Details @if($count<3)<small> (you have not added it yet)</small>@endif </h4>
						<hr class="line-separator">


						<!-- INPUT CONTAINER -->
						<div class="input-container half">
							<label for="files_included" class="rl-label required">Price</label>
							<input type="text" id="files_included" @if($count==3) value="{{$package[2]->price}}" @endif name="price" placeholder="Enter price here...">
						</div>
						<!-- /INPUT CONTAINER -->

						<!-- INPUT CONTAINER -->
						<div class="input-container half">
							<label for="item_dimensions" class="rl-label required">Available Revisions</label>
							<input type="text" id="item_dimensions" @if($count==3) value="{{$package[2]->revisions}}" @endif name="revisions" placeholder="Enter available revisions here...">
						</div>
						<!-- /INPUT CONTAINER -->

						<div class="clearfix"></div>

						<!-- INPUT CONTAINER -->
						<div class="input-container">
							<label for="sv" class="rl-label required">In Days</label>
							<input type="text" id="days" @if($count==3) value="{{$package[2]->days}}" @endif name="days" placeholder="Enter days here...">

						</div>
						<!-- /INPUT CONTAINER -->



						<!-- INPUT CONTAINER -->
						<div class="input-container">
							<label for="item_description" class="rl-label required">Package Description</label>
							<textarea id="item_description" name="detail" placeholder="Enter them package description here...">@if($count==3){{$package[2]->detail}}@endif</textarea>
						</div>
						<!-- /INPUT CONTAINER -->

						<hr class="line-separator">
						<button class="button big dark">Submit Item <span class="primary">for Review</span></button>
					</form>

				</div>
				<!-- /FORM BOX ITEM -->
			</div>
			<!-- /FORM BOX ITEMS -->
			

			<div class="clearfix"></div>
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
<!-- XM LineFill -->
<script src="\js\vendor\jquery.xmlinefill.min.js"></script>
<!-- Side Menu -->
<script src="\js\side-menu.js"></script>
<!-- Dashboard Header -->
<script src="\js\dashboard-header.js"></script>
<!-- Dashboard UploadItem -->
<script src="\js\dashboard-uploaditem.js"></script>
</body>
</html>