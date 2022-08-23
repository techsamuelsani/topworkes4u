<!DOCTYPE html>
<footer>
	<!-- FOOTER TOP -->
	<div id="footer-top-wrap">
		<div id="footer-top">
			<!-- COMPANY INFO -->
			<div class="company-info">
				<figure class="logo small">
					<img src="\images\logo_small.png" alt="logo-small">
				</figure>
				<p>Lancerr.net | Saves your time</p>
				<ul class="company-info-list">
					<li class="company-info-item">
						<span class="icon-present"></span>
						<p><span>{{count(App\Service::all())}}</span> Products</p>
					</li>
					<li class="company-info-item">
						<span class="icon-energy"></span>
						<p><span>{{count(App\Order::all())}}</span> Orders</p>
					</li>
					<li class="company-info-item">
						<span class="icon-user"></span>
						<p><span>{{count(App\User::all())}}</span> Members</p>
					</li>
				</ul>
				<!-- SOCIAL LINKS -->
				<ul class="social-links">
					<li class="social-link fb">
						<a href="#"></a>
					</li>
					<li class="social-link twt">
						<a href="#"></a>
					</li>
					<li class="social-link db">
						<a href="#"></a>
					</li>
					<li class="social-link rss">
						<a href="#"></a>
					</li>
				</ul>
				<!-- /SOCIAL LINKS -->
			</div>
			<!-- /COMPANY INFO -->

			<!-- LINK INFO -->
			<div class="link-info">
				<p class="footer-title">Our Community</p>
				<!-- LINK LIST -->
				<ul class="link-list">
					<li class="link-item">
						<div class="bullet"></div>
						<a href="#">How to Join us</a>
					</li>
					<li class="link-item">
						<div class="bullet"></div>
						<a href="#">Buying and Selling</a>
					</li>

				</ul>
				<!-- /LINK LIST -->
			</div>
			<!-- /LINK INFO -->

			<!-- LINK INFO -->
			<div class="link-info">
				<p class="footer-title">Member Links</p>
				<!-- LINK LIST -->
				<ul class="link-list">

					<li class="link-item">
						<div class="bullet"></div>
						<a href="#">Purchase Credits</a>
					</li>
					<li class="link-item">
						<div class="bullet"></div>
						<a href="#">Withdrawals</a>
					</li>
					<li class="link-item">
						<div class="bullet"></div>
						<a href="#">How to Buy</a>
					</li>
					<li class="link-item">
						<div class="bullet"></div>
						<a href="#">How to Sell</a>
					</li>
				</ul>
				<!-- /LINK LIST -->
			</div>
			<!-- /LINK INFO -->

			<!-- LINK INFO -->
			<div class="link-info">
				<p class="footer-title">Help and FAQs</p>
				<!-- LINK LIST -->
				<ul class="link-list">
					<li class="link-item">
						<div class="bullet"></div>
						<a href="#">Help Center</a>
					</li>
					<li class="link-item">
						<div class="bullet"></div>
						<a href="#">FAQs</a>
					</li>
					<li class="link-item">
						<div class="bullet"></div>
						<a href="#">Terms and Conditions</a>
					</li>
					<li class="link-item">
						<div class="bullet"></div>
						<a href="#">Products Licenses</a>
					</li>
					<li class="link-item">
						<div class="bullet"></div>
						<a href="#">Security Information</a>
					</li>
				</ul>
				<!-- /LINK LIST -->
			</div>
			<!-- /LINK INFO -->
		</div>
	</div>
	<!-- /FOOTER TOP -->

	<!-- FOOTER BOTTOM -->
	<div id="footer-bottom-wrap">
		<div id="footer-bottom">
			<p><span>&copy;&nbsp;</span><a href="/">Lancerr.net</a>&nbsp;&nbsp;All Rights Reserved 2018</p>
		</div>
	</div>
	<!-- /FOOTER BOTTOM -->
</footer>