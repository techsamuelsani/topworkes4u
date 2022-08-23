<?php
$cats=\App\Category::all();
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
		}

		.upbtn {
			border: 2px solid gray;
			color: gray;
			background-color: white;
			padding: 8px 20px;
			border-radius: 8px;
			font-size: 20px;
			font-weight: bold;
		}

		.upload-btn-wrapper input[type=file] {
			font-size: 100px;
			position: absolute;
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
                <h4>Post a Job</h4>
            </div>
            <!-- /HEADLINE -->


			<!-- FORM BOX ITEMS -->
			<div style="width:100%;" class="form-box-items wrap-3-1 left">
				<!-- FORM BOX ITEM -->
				<div class="form-box-item full">
					<h4>Job Specifications</h4>
					<hr class="line-separator">
					@foreach($errors->all() as $error)
					 <lable class="error">*{{$error}}</lable><br/>
					@endforeach
					<br />
					<form id="upload_form"  method="POST" action="{{ route('saveJob') }}">
						@csrf
						<!-- INPUT CONTAINER -->
						<div class="input-container">
							<label for="item_name" class="rl-label required">Job Title (Max 40 Characters)</label>
							<input type="text" id="item_name" name="title" placeholder="Enter title of job here...">
						</div>
						<!-- /INPUT CONTAINER -->

						<!-- INPUT CONTAINER -->
						<div class="input-container half">
							<label for="category" class="rl-label required">Select Category</label>
							<label for="category" class="select-block">
								<select name="categoryId" id="category">
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
								<label for="files_included" class="rl-label required">Budget (Dollars)</label>
								<input type="text" id="files_included" name="budget" placeholder="Enter your budget in Dollars...">
							</div>
							<!-- /INPUT CONTAINER -->

						<!-- INPUT CONTAINER -->
						<div class="input-container">
							<label for="item_description" class="rl-label required">Job Description (Max 1000 characters)</label>
							<textarea id="item_description" name="details" placeholder="Enter Job description here..."></textarea>
						</div>
						<!-- /INPUT CONTAINER -->


							<!-- INPUT CONTAINER -->
							<div class="input-container">
								<label for="item_description" class="rl-label required">Job Requirements</label>
								<textarea id="item_description" name="requirements" placeholder="Enter requirements here..."></textarea>
							</div>
							<!-- /INPUT CONTAINER -->


						<div class="clearfix"></div>

						<!-- INPUT CONTAINER -->
						<div class="input-container">
							<label for="sv" class="rl-label required">Days</label>
							<input type="text" id="days" name="days" placeholder="Enter days here...">

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