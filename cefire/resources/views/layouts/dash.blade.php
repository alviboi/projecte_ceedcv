<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>CEFIRE VALENCIA</title>
		<!-- CSS FILES -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/dashboard.css">
	</head>
	<body>


		<!--HEADER-->
		<header id="top-head" class="uk-position-fixed">
			<div class="uk-container uk-container-expand uk-background-primary">
				<nav class="uk-navbar uk-light" data-uk-navbar="mode:click; duration: 250">
					<div class="uk-navbar-left">
						<div class="uk-navbar-item uk-hidden@m">
							{{-- <a class="uk-logo" href="#"><img class="custom-logo" src="img/dashboard-logo-white.svg" alt=""></a> --}}
						</div>
						<ul class="uk-navbar-nav uk-visible@m">
							<li><a href="#">Accounts</a></li>
							<li>
								<a href="#">Settings <span data-uk-icon="icon: triangle-down"></span></a>
								<div class="uk-navbar-dropdown">
									<ul class="uk-nav uk-navbar-dropdown-nav">
										<li class="uk-nav-header">YOUR ACCOUNT</li>
										<li><a href="#"><span data-uk-icon="icon: info"></span> Summary</a></li>
										<li><a href="#"><span data-uk-icon="icon: refresh"></span> Edit</a></li>
										<li><a href="#"><span data-uk-icon="icon: settings"></span> Configuration</a></li>
										<li class="uk-nav-divider"></li>
										<li><a href="#"><span data-uk-icon="icon: image"></span> Your Data</a></li>
										<li class="uk-nav-divider"></li>
                                        <li><a href="#"><span data-uk-icon="icon: sign-out"></span> Logout</a></li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
									</ul>
								</div>
							</li>
						</ul>
						<div class="uk-navbar-item uk-visible@s">
							<form action="dashboard.html" class="uk-search uk-search-default">
								<span data-uk-search-icon></span>
								<input class="uk-search-input search-field" type="search" placeholder="Search">
							</form>
						</div>
					</div>
					<div class="uk-navbar-right">
						<ul class="uk-navbar-nav">
							<li><a href="#" data-uk-icon="icon:user" title="Your profile" data-uk-tooltip></a></li>
							<li><a href="#" data-uk-icon="icon: settings" title="Settings" data-uk-tooltip></a></li>
							<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-uk-icon="icon:  sign-out" title="Sign Out" data-uk-tooltip></a></li>
							<li><a class="uk-navbar-toggle" data-uk-toggle data-uk-navbar-toggle-icon href="#offcanvas-nav" title="Offcanvas" data-uk-tooltip></a></li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--/HEADER-->
		<!-- LEFT BAR -->
		<aside id="left-col" class="uk-light uk-visible@m">
			<div class="left-logo uk-flex uk-flex-middle">
				{{-- <img class="custom-logo" src="img/dashboard-logo.svg" alt=""> --}}
			</div>
			<div class="left-content-box  content-box-dark">
				{{-- <img src="img/avatar.svg" alt="" class="uk-border-circle profile-img"> --}}
				<h4 class="uk-text-center uk-margin-remove-vertical text-light">John Doe</h4>

				<div class="uk-position-relative uk-text-center uk-display-block">
				    <a href="#" class="uk-text-small uk-text-muted uk-display-block uk-text-center" data-uk-icon="icon: triangle-down; ratio: 0.7">Admin</a>
				    <!-- user dropdown -->
				    <div class="uk-dropdown user-drop" data-uk-dropdown="mode: click; pos: bottom-center; animation: uk-animation-slide-bottom-small; duration: 150">
				    	<ul class="uk-nav uk-dropdown-nav uk-text-left">
								<li><a href="#"><span data-uk-icon="icon: info"></span> Summary</a></li>
								<li><a href="#"><span data-uk-icon="icon: refresh"></span> Edit</a></li>
								<li><a href="#"><span data-uk-icon="icon: settings"></span> Configuration</a></li>
								<li class="uk-nav-divider"></li>
								<li><a href="#"><span data-uk-icon="icon: image"></span> Your Data</a></li>
								<li class="uk-nav-divider"></li>
								<li><a href="#"><span data-uk-icon="icon: sign-out"></span> Sign Out</a></li>
					    </ul>
				    </div>
				    <!-- /user dropdown -->
				</div>
			</div>

			<div class="left-nav-wrap">
				<ul class="uk-nav uk-nav-default uk-nav-parent-icon" data-uk-nav>
					<li class="uk-nav-header">ACTIONS</li>
					<li><a href="#" onclick="canvi('messages')"><span data-uk-icon="icon: comments" class="uk-margin-small-right"></span>Messages</a></li>
					<li><a href="#"><span data-uk-icon="icon: users" class="uk-margin-small-right"></span>Friends</a></li>
					<li class="uk-parent"><a href="#"><span data-uk-icon="icon: thumbnails" class="uk-margin-small-right"></span>Templates</a>
						<ul class="uk-nav-sub">
							<li><a title="Article" href="https://zzseba78.github.io/Kick-Off/article.html">Article</a></li>
							<li><a title="Album" href="https://zzseba78.github.io/Kick-Off/album.html">Album</a></li>
							<li><a title="Cover" href="https://zzseba78.github.io/Kick-Off/cover.html">Cover</a></li>
							<li><a title="Cards" href="https://zzseba78.github.io/Kick-Off/cards.html">Cards</a></li>
							<li><a title="News Blog" href="https://zzseba78.github.io/Kick-Off/newsBlog.html">News Blog</a></li>
							<li><a title="Price" href="https://zzseba78.github.io/Kick-Off/price.html">Price</a></li>
							<li><a title="Login" href="https://zzseba78.github.io/Kick-Off/login.html">Login</a></li>
							<li><a title="Login-Dark" href="https://zzseba78.github.io/Kick-Off/login-dark.html">Login - Dark</a></li>
						</ul>
					</li>
					<li><a href="#"><span data-uk-icon="icon: album" class="uk-margin-small-right"></span>Albums</a></li>
					<li><a href="#"><span data-uk-icon="icon: thumbnails" class="uk-margin-small-right"></span>Featured Content</a></li>
					<li><a href="#"><span data-uk-icon="icon: lifesaver" class="uk-margin-small-right"></span>Tips</a></li>
					<li class="uk-parent">
						<a href="#"><span data-uk-icon="icon: comments" class="uk-margin-small-right"></span>Reports</a>
						<ul class="uk-nav-sub">
							<li><a href="#">Sub item</a></li>
							<li><a href="#">Sub item</a></li>
						</ul>
					</li>
				</ul>
				<div class="left-content-box uk-margin-top">

						<h5>Daily Reports</h5>
						<div>
							<span class="uk-text-small">Traffic <small>(+50)</small></span>
							<progress class="uk-progress" value="50" max="100"></progress>
						</div>
						<div>
							<span class="uk-text-small">Income <small>(+78)</small></span>
							<progress class="uk-progress success" value="78" max="100"></progress>
						</div>
						<div>
							<span class="uk-text-small">Feedback <small>(-12)</small></span>
							<progress class="uk-progress warning" value="12" max="100"></progress>
						</div>

				</div>

			</div>
			<div class="bar-bottom">
				<ul class="uk-subnav uk-flex uk-flex-center uk-child-width-1-5" data-uk-grid>
					<li>
						<a href="#" class="uk-icon-link" data-uk-icon="icon: home" title="Home" data-uk-tooltip></a>
					</li>
					<li>
						<a href="#" class="uk-icon-link" data-uk-icon="icon: settings" title="Settings" data-uk-tooltip></a>
					</li>
					<li>
						<a href="#" class="uk-icon-link" data-uk-icon="icon: social"  title="Social" data-uk-tooltip></a>
					</li>

					<li>
						<a href="#" class="uk-icon-link" data-uk-tooltip="Sign out" data-uk-icon="icon: sign-out"></a>
					</li>
				</ul>
			</div>
		</aside>
        <!-- /LEFT BAR -->
       <div id="mycontent">
        @yield('content')
       </div>





		<!-- OFFCANVAS -->
		<div id="offcanvas-nav" data-uk-offcanvas="flip: true; overlay: true">
			<div class="uk-offcanvas-bar uk-offcanvas-bar-animation uk-offcanvas-slide">
				<button class="uk-offcanvas-close uk-close uk-icon" type="button" data-uk-close></button>
				<ul class="uk-nav uk-nav-default">
					<li class="uk-active"><a href="#">Active</a></li>
					<li class="uk-parent">
						<a href="#">Parent</a>
						<ul class="uk-nav-sub">
							<li><a href="#">Sub item</a></li>
							<li><a href="#">Sub item</a></li>
						</ul>
					</li>
					<li class="uk-nav-header">Header</li>
					<li><a href="#js-options"><span class="uk-margin-small-right uk-icon" data-uk-icon="icon: table"></span> Item</a></li>
					<li><a href="#"><span class="uk-margin-small-right uk-icon" data-uk-icon="icon: thumbnails"></span> Item</a></li>
					<li class="uk-nav-divider"></li>
					<li><a href="#"><span class="uk-margin-small-right uk-icon" data-uk-icon="icon: trash"></span> Item</a></li>
				</ul>
				<h3>Title</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			</div>
		</div>
		<!-- /OFFCANVAS -->

        <!-- JS FILES -->
        {{-- <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script> --}}

		<script src="js/Chart.min.js"></script>
        <script src="js/chartScripts.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/home.js') }}"></script>
	</body>
</html>