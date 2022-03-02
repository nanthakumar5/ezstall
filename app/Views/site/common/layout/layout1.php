<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="icon" href="/favicon.ico">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="theme-color" content="#000000">
		<meta name="description" content="Web site created using create-react-app">
		<link rel="apple-touch-icon" href="/logo192.png">
		<link rel="manifest" href="/manifest.json">
		<title>React App</title>
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/site/css/style.css">
		
    	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/plugins/fontawesome-free/css/all.min.css">
    	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/plugins/icheck-bootstrap/css/icheck-bootstrap.min.css">
    	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/adminlte.min.css">
    	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/custom.css">
    		<!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- JavaScript Bundle with Popper -->
	</head>
	<body>
		<noscript>You need to enable JavaScript to run this app.</noscript>
		<div id="root">
			<div class="App">
				<div class="content">
					<section class="signInSection">
						<div class="top-nav">
							<nav class="navbar navbar-expand-lg navbar-dark bg-custom-dark">
								<div class="container-lg m-1rem-sm">
									<a href="#home" class="navbar-brand">
										<img src="<?php echo base_url() ?>/assets/images/ezstall.png" class="logo" alt="Logo">
									</a>
									<button aria-controls="responsive-navbar-nav" type="button" aria-label="Toggle navigation" class="navbar-toggler collapsed">
										<span class="navbar-toggler-icon"></span>
									</button>
									<div class="navbar-collapse collapse" id="responsive-navbar-nav">
										<div class="me-auto ml-auto navbar-nav">
											<a href="/" data-rr-ui-event-key="/" class="ml-2rem nav-link">Home</a>
											<a href="/Events" data-rr-ui-event-key="/Events" class="ml-2rem nav-link">Events</a>
											<a href="#/stall" data-rr-ui-event-key="#/stall" class="ml-2rem nav-link">Stall</a>
											<a href="#/faq" data-rr-ui-event-key="#/faq" class="ml-2rem nav-link">FAQ</a>
											<a href="#/about" data-rr-ui-event-key="#/about" class="ml-2rem nav-link">About</a>
											<a href="#/contact" data-rr-ui-event-key="#/contact" class="ml-2rem nav-link">Contact Us</a>
										</div>
										<div class="navbar-nav">
											<a href="<?php echo base_url()?>/login" data-rr-ui-event-key="/SignIn" class="ml-0 nav-link">
												<img src="<?php echo base_url()?>/assets/images/profile.svg" class="profileIcon" alt="Profile Icon">Sign In / </a>
											<a href="<?php echo base_url()?>/register" data-rr-ui-event-key="/SignUp" class="ml-0 nav-link">Sign Up</a>
										</div>
									</div>
								</div>
							</nav>
						</div>
						<?php echo $this->include('site/common/notification/notification1') ?>
						<?php $this->renderSection('content') ?>
					</section>
					<section class="footerPanel">
						<div class="subscriptionPanel">
							<h3 class="newsTitle">Newsletter Subscription</h3>
							<div class="subscriptionArea">
								<input class="subscriptionInput" type="email" placeholder="Email address">
								<button class="subscriptionBtn">Subscribe</button>
							</div>
						</div>
						<div class="footerBottom">
							<div class="panel1">
								<img src="<?php echo base_url() ?>/assets/images/ezstall.png">
								<p class="footmainContent">Nemo enim ipsam volutem quia volutas sit aspernatur aut odit aut fugit, sed quia consntur magni dolores eos qui ratne voluptatem sequi nesciunt.</p>
							</div>
							<div class="panel2">
								<h5>Quick Menu</h5>
								<ul>
									<li>
										<a href="#">Home</a>
									</li>
									<li>
										<a href="#">Events</a>
									</li>
									<li>
										<a href="#">Stalls</a>
									</li>
									<li>
										<a href="#">FAQ</a>
									</li>
									<li>
										<a href="#">About</a>
									</li>
									<li>
										<a href="#">Contact Us</a>
									</li>
								</ul>
							</div>
							<div class="panel3">
								<h5 class="mar-b-3vh">Upcoming Events</h5>
								<span class="footerucEvents">
									<h5>Excepteur sint occaecat</h5>
									<p>26 Jan 2021</p>
								</span>
								<span class="footerucEvents">
									<h5>Sed ut perspiciatis unde</h5>
									<p>26 Jan 2021</p>
								</span>
								<span class="footerucEvents">
									<h5>Quis autem vel eum</h5>
									<p>26 Jan 2021</p>
								</span>
							</div>
							<div class="panel4">
								<h5 class="mar-b-3vh">Contact Us</h5>
								<p>
									<a href="mailto:contact@business.com">contact@business.com</a>
								</p>
								<p>
									<a href="tel:+(575) 936-6183">(575) 936-6183</a>
								</p>
								<p class="pt-top-1vh">
									<b class="colorWhite">Opening Hours</b>
								</p>
								<p class="colorWhite">9AM - 5PM, Mon to Fri</p>
								<span class="socialIcons">
									<svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.2" baseProfile="tiny" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
										<path d="M13 10h3v3h-3v7h-3v-7h-3v-3h3v-1.255c0-1.189.374-2.691 1.118-3.512.744-.823 1.673-1.233 2.786-1.233h2.096v3h-2.1c-.498 0-.9.402-.9.899v2.101z"></path>
									</svg>
									<svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.2" baseProfile="tiny" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
										<path d="M18.89 7.012c.808-.496 1.343-1.173 1.605-2.034-.786.417-1.569.703-2.351.861-.703-.756-1.593-1.14-2.66-1.14-1.043 0-1.924.366-2.643 1.078-.715.717-1.076 1.588-1.076 2.605 0 .309.039.585.117.819-3.076-.105-5.622-1.381-7.628-3.837-.34.601-.51 1.213-.51 1.846 0 1.301.549 2.332 1.645 3.089-.625-.053-1.176-.211-1.645-.47 0 .929.273 1.705.82 2.388.549.676 1.254 1.107 2.115 1.291-.312.08-.641.118-.979.118-.312 0-.533-.026-.664-.083.23.757.664 1.371 1.291 1.841.625.472 1.344.721 2.152.743-1.332 1.045-2.855 1.562-4.578 1.562-.422 0-.721-.006-.902-.038 1.697 1.102 3.586 1.649 5.676 1.649 2.139 0 4.029-.542 5.674-1.626 1.645-1.078 2.859-2.408 3.639-3.974.784-1.564 1.172-3.192 1.172-4.892v-.468c.758-.57 1.371-1.212 1.84-1.921-.68.293-1.383.492-2.11.593z"></path>
									</svg>
									<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
										<path d="M879.5 470.4c-.3-27-.4-54.2-.5-81.3h-80.8c-.3 27-.5 54.1-.7 81.3-27.2.1-54.2.3-81.2.6v80.9c27 .3 54.2.5 81.2.8.3 27 .3 54.1.5 81.1h80.9c.1-27 .3-54.1.5-81.3 27.2-.3 54.2-.4 81.2-.7v-80.9c-26.9-.2-54.1-.2-81.1-.5zm-530 .4c-.1 32.3 0 64.7.1 97 54.2 1.8 108.5 1 162.7 1.8-23.9 120.3-187.4 159.3-273.9 80.7-89-68.9-84.8-220 7.7-284 64.7-51.6 156.6-38.9 221.3 5.8 25.4-23.5 49.2-48.7 72.1-74.7-53.8-42.9-119.8-73.5-190-70.3-146.6-4.9-281.3 123.5-283.7 270.2-9.4 119.9 69.4 237.4 180.6 279.8 110.8 42.7 252.9 13.6 323.7-86 46.7-62.9 56.8-143.9 51.3-220-90.7-.7-181.3-.6-271.9-.3z"></path>
									</svg>
									<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
										<path d="M512 306.9c-113.5 0-205.1 91.6-205.1 205.1S398.5 717.1 512 717.1 717.1 625.5 717.1 512 625.5 306.9 512 306.9zm0 338.4c-73.4 0-133.3-59.9-133.3-133.3S438.6 378.7 512 378.7 645.3 438.6 645.3 512 585.4 645.3 512 645.3zm213.5-394.6c-26.5 0-47.9 21.4-47.9 47.9s21.4 47.9 47.9 47.9 47.9-21.3 47.9-47.9a47.84 47.84 0 0 0-47.9-47.9zM911.8 512c0-55.2.5-109.9-2.6-165-3.1-64-17.7-120.8-64.5-167.6-46.9-46.9-103.6-61.4-167.6-64.5-55.2-3.1-109.9-2.6-165-2.6-55.2 0-109.9-.5-165 2.6-64 3.1-120.8 17.7-167.6 64.5C132.6 226.3 118.1 283 115 347c-3.1 55.2-2.6 109.9-2.6 165s-.5 109.9 2.6 165c3.1 64 17.7 120.8 64.5 167.6 46.9 46.9 103.6 61.4 167.6 64.5 55.2 3.1 109.9 2.6 165 2.6 55.2 0 109.9.5 165-2.6 64-3.1 120.8-17.7 167.6-64.5 46.9-46.9 61.4-103.6 64.5-167.6 3.2-55.1 2.6-109.8 2.6-165zm-88 235.8c-7.3 18.2-16.1 31.8-30.2 45.8-14.1 14.1-27.6 22.9-45.8 30.2C695.2 844.7 570.3 840 512 840c-58.3 0-183.3 4.7-235.9-16.1-18.2-7.3-31.8-16.1-45.8-30.2-14.1-14.1-22.9-27.6-30.2-45.8C179.3 695.2 184 570.3 184 512c0-58.3-4.7-183.3 16.1-235.9 7.3-18.2 16.1-31.8 30.2-45.8s27.6-22.9 45.8-30.2C328.7 179.3 453.7 184 512 184s183.3-4.7 235.9 16.1c18.2 7.3 31.8 16.1 45.8 30.2 14.1 14.1 22.9 27.6 30.2 45.8C844.7 328.7 840 453.7 840 512c0 58.3 4.7 183.2-16.2 235.8z"></path>
									</svg>
								</span>
							</div>
						</div>
						<div class="copyRight">
							<p>
								<center>© Copyright 2022 - EZ Stall. All Rights Reserved. Privacy Policy | Terms and Conditions</center>
							</p>
						</div>
					</section>
				</div>
			</div>
		</div>
		<iframe src="https://www.ciuvo.com/ciuvo/globalstorage?version=2.1.3" style="position: absolute; width: 1px; height: 1px; left: -9999px;"></iframe>
	</body>
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="<?php echo base_url();?>/assets/plugins/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url();?>/assets/plugins/jquery-validation/jquery.validate.min.js"></script>
	<script src="<?php echo base_url();?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url();?>/assets/js/adminlte.min.js"></script>
	<script src="<?php echo base_url();?>/assets/js/custom.js"></script>
<?php $this->renderSection('js') ?>
</html>