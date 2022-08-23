<?php
$user=Auth::user();
?>
<!-- SIDE MENU -->
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
			<a href="\{{$user->username}}">
				<div class="outer-ring">
					<div class="inner-ring"></div>
					<figure class="user-avatar">
						<img style="width: 40px; height: 40px;" src="\image\{{$user->picLink}}" alt="avatar">
					</figure>
				</div>
			</a>
			<!-- /USER AVATAR -->

			<!-- USER INFORMATION -->
			<p class="user-name">{{$user->name}}</p>
			<p class="user-money">${{$user->balance}}</p>
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


		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item interactive">
			<a href="#">
				<span class="sl-icon icon-envelope"></span>
				Messages
				<!-- SVG ARROW -->
				<svg class="svg-arrow">
					<use xlink:href="#svg-arrow"></use>
				</svg>
				<!-- /SVG ARROW -->
			</a>

			<!-- INNER DROPDOWN -->
			<ul class="inner-dropdown">
				<!-- INNER DROPDOWN ITEM -->
				<li class="inner-dropdown-item">
					<a href="\inbox">Your Inbox</a>
					<!-- PIN -->
					<span class="pin soft-edged secondary"></span>
					<!-- /PIN -->
				</li>
				<!-- /INNER DROPDOWN ITEM -->

			</ul>
			<!-- INNER DROPDOWN -->

			<!-- PIN -->
			<span class="pin soft-edged big secondary">!</span>
			<!-- /PIN -->
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="/{{$user->username}}/purchases">
				<span class="sl-icon icon-tag"></span>
				Your Purchases
			</a>
		</li>
		<!-- /DROPDOWN ITEM -->
		@if($user->type=="seller")
		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="/{{$user->username}}/sales">
				<span class="sl-icon icon-tag"></span>
				Your Sales
			</a>
		</li>
		<!-- /DROPDOWN ITEM -->
		@endif

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="/{{$user->username}}/recharge">
				<span class="sl-icon icon-credit-card"></span>
				Recharge
			</a>
		</li>
		<!-- /DROPDOWN ITEM -->
	</ul>
	<!-- /DROPDOWN -->


	<!-- SIDE MENU TITLE -->
	<p class="side-menu-title">User Tools</p>
	<!-- /SIDE MENU TITLE -->

	<!-- DROPDOWN -->
	<ul class="dropdown dark hover-effect">
		@if($user->type=="seller")
		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="/{{$user->username}}/services/manage">
				<span class="sl-icon icon-folder-alt"></span>
				Manage Sevices
			</a>
		</li>
		<!-- /DROPDOWN ITEM -->
		@endif

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="/jobs/manage/">
				<span class="sl-icon icon-folder-alt"></span>
				Manage Jobs
			</a>
		</li>
		<!-- /DROPDOWN ITEM -->

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="/{{$user->username}}/withdrawals">
				<span class="sl-icon icon-wallet"></span>
				Withdrawals
			</a>
		</li>
		<!-- /DROPDOWN ITEM -->
	</ul>
	<!-- /DROPDOWN -->
	<p class="side-menu-title">HELP</p>
	<!-- /SIDE MENU TITLE -->

	<!-- DROPDOWN -->
	<ul class="dropdown dark hover-effect">

		<!-- DROPDOWN ITEM -->
		<li class="dropdown-item">
			<a href="/tickets">
				<span class="sl-icon icon-wallet"></span>
				Your Tickets
			</a>
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