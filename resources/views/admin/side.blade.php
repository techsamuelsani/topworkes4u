<!-- SIDE MENU -->
<?php
 $user=Auth::user();  ?>
<div id="dashboard-options-menu" class="side-menu dashboard left closed">
	<!-- SVG PLUS -->
	<svg class="svg-plus">
		<use xlink:href="#svg-plus"></use>
	</svg>
	<!-- /SVG PLUS -->

	<!-- SIDE MENU HEADER -->
	<div class="side-menu-header">
		<!-- USER QUICKVIEW -->
		<div class="user-quickview">
			<!-- USER AVATAR -->
			<a href="/admin">
				<div class="outer-ring">
					<div class="inner-ring"></div>
					<figure class="user-avatar">
						<img style="height:40px; width:40px;" src="\image\{{$user->picLink}}" alt="avatar">
					</figure>
				</div>
			</a>
			<!-- /USER AVATAR -->

			<!-- USER INFORMATION -->
			<p class="user-name">{{$user->name}}</p>
			<p class="user-money">Admin</p>
			<!-- /USER INFORMATION -->
		</div>
		<!-- /USER QUICKVIEW -->
	</div>
	<!-- /SIDE MENU HEADER -->

	<!-- SIDE MENU TITLE -->
	<p class="side-menu-title">Your Account</p>
	<!-- /SIDE MENU TITLE -->

	<!-- DROPDOWN -->
	<ul class="dropdown dark hover-effect interactive">
		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="\{{$user->username}}\settings">
				<span class="sl-icon icon-settings"></span>
				Account Settings
			</a>
		</li>
		<!-- /DROPDOWN ITEM -->
	</ul>
	<!-- /DROPDOWN -->

	<!-- SIDE MENU TITLE -->
	<p class="side-menu-title">Info &amp; Statistics</p>
	<!-- /SIDE MENU TITLE -->

	<!-- DROPDOWN -->
	<ul class="dropdown dark hover-effect">


		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="/admin">
				<span class="sl-icon icon-chart"></span>
				Home
			</a>
		</li>
		<!-- /DROPDOWN ITEM -->
	</ul>
	<!-- /DROPDOWN -->

	<!-- SIDE MENU TITLE -->
	<p class="side-menu-title">Manage</p>
	<!-- /SIDE MENU TITLE -->

	<!-- DROPDOWN -->
	<ul class="dropdown dark hover-effect">
		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="\admin\sellers">
				<span class="sl-icon icon-arrow-up-circle"></span>
				Pending Sellers
			</a>
			<span class="pin soft-edged big primary">{{count(App\User::where('status',3)->get())}}</span>
			
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="\admin\services">
				<span class="sl-icon icon-arrow-up-circle"></span>
				Pending Services
			</a>
			<span class="pin soft-edged big primary">{{count(App\Service::where('isVerified',0)->get())}}</span>
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="\admin\jobs">
				<span class="sl-icon icon-arrow-up-circle"></span>
				Pending Buyer Requests
			</a>
			<span class="pin soft-edged big primary">{{count(App\Job::where('isActive',2)->get())}}</span>
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="\admin\withdrawals">
				<span class="sl-icon icon-arrow-up-circle"></span>
				Pending Withdrawals
			</a>
			<span class="pin soft-edged big primary">{{count(App\Withdrawal::where('status','Panding')->get())}}</span>
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="\admin\recharges">
				<span class="sl-icon icon-arrow-up-circle"></span>
				Pending Recharges
			</a>
			<span class="pin soft-edged big primary">{{count(App\Recharge::where('status',0)->get())}}</span>
		</li>
		<!-- /DROPDOWN ITEM -->



	</ul>
	<!-- /DROPDOWN -->
	<form method="POST" action="{{ route('logout') }}">
		@csrf
		<button href="#" class="button medium secondary">Logout</button>
	</form>
</div>
<!-- /SIDE MENU -->