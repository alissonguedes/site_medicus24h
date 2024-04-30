<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="{{ asset('assets/node_modules/materialize-css/dist/css/materialize.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/node_modules/@splidejs/splide/dist/css/splide.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/styles/defaults/fonts.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/defaults/colors.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/defaults/animate.css') }}">

<style>
	.navbar {
		position: relative;
		z-index: 997;
	}

	.navbar-fixed,
	.row .col[class*=push-],
	.row .col[class*=pull-],
	nav .nav-wrapper,
	nav .sidenav-trigger {
		position: relative;
	}

	.navbar .navbar-main {
		padding: 0 8px 0 310px;
	}

	.navbar-fixed nav {
		position: fixed;
	}

	nav {
		width: 100%;
		height: 64px;
		line-height: 64px;
		background-color: #9c27b0;
	}

	nav .sidenav-trigger {
		margin: 0;
	}

	.navbar .navbar-dark .header-search-wrapper i,
	.navbar .navbar-dark ul a {
		color: #fff;
	}

	nav ul a,
	.navbar .notification-button,
	.navbar .toggle-fullscreen {
		line-height: normal;
	}

	/* .navbar .notification-button,
	.navbar .toggle-fullscreen,
	.navbar li a:not(.profile-button) {
		line-height: 1;
	} */
	.navbar .notification-badge {
		font-family: Muli, sans-serif;
		position: relative;
		top: -20px;
		right: 5px;
		margin: 0 -0.8rem;
		padding: 2px 5px;
		color: #fff;
		border-radius: 50%;
		background-color: #00bcd4;
		box-shadow: 0 0 10px 0 #00bcd4;
	}

	.navbar-nav .logo span {
		position: relative;
		top: -25px;
		display: block;
		width: 45px;
		height: 45px;
		border-radius: 100%;
		background-image: url("{{ asset('assets/img/logo/coracao.png') }}");
		background-repeat: no-repeat;
		background-size: contain;
		background-position: bottom;
	}

	.navbar-nav .logo span::after {
		content: '';
		width: 60px;
		height: 60px;
		position: absolute;
		background-color: #ffffff;
		background-repeat: no-repeat;
		background-size: 100%;
		background-position: center;
		left: 50%;
		right: 50%;
		top: 50%;
		bottom: 50%;
		border-radius: 100%;
		margin-left: -30px;
		margin-right: -30px;
		margin-top: -30px;
		margin-bottom: -30px;
		z-index: -1;
	}

	.avatar-status {
		line-height: 45px;
		position: relative;
		display: inline-block;
		width: 28px;
		vertical-align: bottom;
		border-radius: 100%;
	}

	.avatar-status,
	.card-alert .alert-circle,
	.material-icons,
	.text-ellipsis,
	.text-nowrap {
		white-space: nowrap;
	}

	.avatar-status img {
		width: 100%;
		max-width: 100%;
		height: auto;
		border: 0;
		border-radius: 100%;
		background: #e6e6e6;
	}

	.avatar-online i {
		background-color: #00e676;
	}

	.avatar-status i {
		position: absolute;
		right: -2px;
		bottom: 18px;
		width: 9px !important;
		height: 9px !important;
		border: 1px solid #fff;
		border-radius: 100%;
	}

	#input-search-header {
		position: absolute;
		top: 0;
		z-index: 9999999;
		height: 60px;
		background-color: #ffffff;
		box-shadow: none !important;
		border: none !important;
		display: none;
		padding: 0 30px;
		width: calc(100% - 60px);
	}

	@media only screen and (min-width: 1px) {

		nav,
		nav .nav-wrapper i,
		nav a.sidenav-trigger,
		nav a.sidenav-trigger i {
			height: 50px;
			line-height: 50px;
		}
	}

	@media only screen and (max-width: 600px) {
		.notification-button i {
			font-size: 29px;
			position: relative;
			top: 12px;
		}
	}

	@media only screen and (max-width: 992px) {
		.navbar-nav {
			position: fixed;
			bottom: 0;
			z-index: 999999;
			background: var(--red-lighten-1);
			left: 0;
			right: 0;
			display: flex;
			place-content: space-between;
			height: 50px;
			line-height: 50px;
			margin: 0 3%;
			border-radius: 50px 50px 0 0;
			padding: 0 25px !important;
		}

		.navbar-nav li:not(.logo) a {
			border-radius: 50%;
			width: 40px;
			height: 40px;
			line-height: 0;
			padding: 0 8px;
		}

		nav .sidenav-trigger {
			margin: 5px 0;
		}

		.navbar-nav li a i {
			line-height: 40px;
			/* padding: 0; */
		}
	}

	@media only screen and (min-width: 992px) {
		html {
			font-size: 14.5px;
		}

		#input-search-header {
			width: calc(100% - 340px);
			padding: 0 20px 0 320px;
		}
	}
</style>
