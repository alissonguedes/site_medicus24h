<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="{{ asset('assets/node_modules/materialize-css/dist/css/materialize.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/node_modules/perfect-scrollbar/css/perfect-scrollbar.css') }}">
<link rel="stylesheet" href="{{ asset('assets/node_modules/@splidejs/splide/dist/css/splide.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/styles/defaults/fonts.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/defaults/colors.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/defaults/animate.css') }}">

<style>
	.btn:focus,
	.btn:hover,
	.btn:active,
	.btn.active {
		background-color: inherit !important;
	}

	.mr-3 {
		margin-right: 3%;
	}

	body {
		overflow: hidden;
		font-family: 'Montserrat', sans-serif;
	}

	.sidenav,
	main,
	header,
	.navbar-main {
		transition: all 400ms;
	}

	main {
		display: block;
		height: calc(100vh - 54px);
		position: absolute;
		left: 0;
		right: 0;
		padding: 30px 30px 30px 330px;
	}

	main::before,
	main::after {
		content: '';
		position: fixed;
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
		z-index: -1;
	}

	main::before {
		background-image: url("{{ asset('assets/img/app/bg-white-landscape.jpg') }}");
		background-size: cover;
		background-repeat: no-repeat;
	}

	main::after {
		background-color: var(--teal-lighten-1);
		opacity: 0.7;
	}

	main>.main-container {
		position: relative;
		background-color: #ffffff;
		margin: 0;
		margin-bottom: 120px;
		width: auto;
		height: calc(100vh - 120px);
		max-width: 100%;
		overflow: hidden;
		border-radius: 24px;
		padding: 0;
		border-bottom-width: 10px;
		border-top-width: 10px;
		border-color: var(--teal-darken-4);
		border-style: solid none solid;
	}

	main>.main-container>.container {
		position: relative;
		overflow: auto;
		padding: 20px;
		max-width: inherit;
		width: inherit;
		height: 100%;
	}

	.material-symbols-outlined {
		font-size: 28px;
	}

	small {
		font-size: .8rem;
	}

	#page-title {
		position: absolute;
		left: 0;
		top: 0;
		margin: 0;
		padding: 0;
		height: inherit;
		line-height: inherit;
		vertical-align: middle;
		color: var(--teal-lighten-1);
		font-size: 22px;
		font-weight: 400;
		text-transform: uppercase;
		max-width: calc(100% - 120px);
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		padding-left: 12px;
	}

	#page-title .icon,
	#page-title .btn {
		margin: 0;
		padding: 0;
		vertical-align: middle;
		height: inherit;
		line-height: inherit;
		font-weight: 300;
		font-size: 34px;
		top: -3px;
		position: relative;
		/* margin-right: 10px; */
	}

	#page-title .btn {
		width: 34px;
		height: 34px;
		line-height: 34px;
		vertical-align: middle;
		color: inherit;
	}

	#page-title::before {
		content: '';
		height: 80%;
		width: 10px;
		background-color: var(--red-lighten-1);
		display: none;
		float: left;
		margin-right: 10px;
		border-radius: 0 0 10px 10px;
	}

	#page-title a {
		color: inherit;
	}

	.progress {
		position: absolute;
		height: 5px;
		display: block;
		width: 100%;
		background-color: #acece6;
		border-radius: 2px;
		margin: 0;
		overflow: hidden;
		bottom: 0;
		left: 300px;
		right: 0;
		border-radius: 0;
		z-index: 999999;
		display: none;
	}

	.navbar {
		position: relative;
		z-index: 997;
	}

	.navbar-color {
		background-color: #ffffff;
	}

	.navbar-color.navbar-transparent {
		background-color: transparent;
		backdrop-filter: blur(3px);
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

	nav [class*=mdi-],
	nav [class^=mdi-],
	nav i {
		font-size: 24px;
		line-height: 56px;
		display: block;
		height: 56px;
	}

	nav .sidenav-trigger {
		margin: 0;
	}

	.navbar .notification-button,
	.navbar .toggle-fullscreen {
		line-height: 1;
	}

	.navbar .notification-button,
	.navbar .toggle-fullscreen,
	.navbar ul a {
		color: var(--teal-lighten-1);
	}

	.navbar .notification-button i {
		width: 28px;
	}

	.navbar .notification-badge {
		font-family: 'Montserrat', sans-serif;
		position: relative;
		top: -15px;
		right: 30px;
		margin: 0 -0.9999rem;
		color: #fff;
		border-radius: 50%;
		background-color: var(--red-lighten-1);
		box-shadow: 0 0 10px 0 var(--red-lighten-1);
		height: 22px;
		display: inline-block;
		width: 22px;
		padding: 0;
		line-height: 22px;
		text-align: center;
		font-size: 0.75rem;
		font-weight: bold;
	}

	.navbar-nav .logo span {
		position: relative;
		top: -5px;
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
		line-height: 50px;
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
		height: 64px;
		background-color: #ffffff;
		box-shadow: none !important;
		border: none !important;
		display: none;
		/* opacity: 0; */
		padding: 0 30px;
		width: calc(100% - 60px);
		transition: opacity 3000ms;
	}

	#input-search-header.show {
		display: block;
		opacity: 1;
	}

	.brand-logo img {
		width: 150px;
		margin: 10px;
	}

	.application-logo {
		height: 64px;
		position: relative;
	}

	.btn-menu,
	.btn.sidenav-close {
		position: absolute;
		z-index: 999999;
		top: 10px;
		left: 9px;
	}

	.btn.sidenav-close {
		left: auto;
		right: 9px;
		top 10px;
	}

	.btn-menu,
	.btn-menu:hover,
	.btn-menu:focus {
		background-color: transparent !important;
	}

	.application-logo {
		padding: 0px 18px;
		background-color: #ffffff;
		float: left;
		position: relative;
		text-align: center;
		width: inherit;
		display: block;
		z-index: 999998;
		padding: 10px 0;
		width: 100%;
	}

	.application-logo:before,
	.navbar-main:after {
		content: '';
		position: absolute;
		left: 0;
		right: 0;
		bottom: -1px;
		height: 5px;
		z-index: 999;
		border-bottom: 5px solid #acece6;
	}

	.application-logo:before {
		border-bottom: 5px solid var(--teal-lighten-1);
	}

	.application-logo a {
		line-height: 0;
	}

	.application-logo img {
		width: 130px;
	}

	aside {
		position: fixed;
		top: 0;
		height: 100%;
		background-color: #ffffff;
		z-index: 9999999;
		overflow: hidden;
	}

	nav ul a,
	.sidenav li>a,
	.sidenav li>a>i {
		color: var(--grey-darken-4);
	}

	nav ul a {
		top: -1px;
	}

	.nav-collapsed header nav,
	.nav-collapsed .navbar .navbar-main,
	.nav-collapsed main {
		padding-left: 90px;
	}

	.nav-collapsed header .navbar .navbar-main {
		padding-left: 70px;
	}

	.nav-collapsed aside {
		width: 60px;
	}

	.nav-collapsed #input-search-header {
		width: calc(100% - 115px);
		padding: 0 30px 0 90px;
	}

	.nav-collapsed aside .application-logo,
	.nav-collapsed aside ul li a.submenu-open:after {
		display: none;
	}

	.nav-collapsed aside .sidenav {
		width: inherit;
		transform: translateX(0);
	}

	.nav-collapsed aside:hover .sidenav {
		width: 300px;
	}

	.nav-collapsed aside:hover .application-logo {
		display: block;
	}

	aside ul {
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		padding-top: 0;
		padding-bottom: 20px;
		height: auto;
		transform: translate(100%, 0);
		transition: transform 0.6s ease;
		-webkit-transition: -webkit-transform 0.5s ease;
	}

	.sidenav,
	aside ul {
		background-color: inherit !important;
	}

	.sidenav {
		/* overflow-x: hidden; */
		/* overflow: hidden; */
	}

	aside ul.in {
		opacity: 1;
		display: block;
		-webkit-transform: translate3d(0, 0, 0);
		-moz-transform: translate3d(0, 0, 0);
		-ms-transform: translate3d(0, 0, 0);
		-o-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	}

	aside ul.out {
		opacity: 1;
		display: block;
		-webkit-transform: translate3d(-30%, 0, 0);
		-moz-transform: translate3d(-30%, 0, 0);
		-ms-transform: translate3d(-30%, 0, 0);
		-o-transform: translate3d(-30%, 0, 0);
		transform: translate3d(-30%, 0, 0);
	}

	aside ul li {
		display: block;
		position: relative;
		margin: 10px 15px 0 0;
		border-radius: 0 24px 24px 0;
	}

	aside ul li a,
	.sidenav li>a>i,
	.sidenav li>a>[class^="mdi-"],
	.sidenav li>a li>a>[class*="mdi-"],
	.sidenav li>a>i.material-icons,
	.sidenav li>a>i.material-symbols-outlined,
	aside li>a>i.material-symbols-outlined {
		line-height: 48px;
		letter-spacing: 0.5px;
		margin: 0;
		font-weight: 300;
	}

	.sidenav li>a>i.material-icons,
	.sidenav li>a>i.material-symbols-outlined,
	aside li>a>i.material-symbols-outlined {
		margin-right: 15px;
	}

	.sidenav li>a,
	aside ul li a,
	aside ul li span {
		display: block !important;
		padding: 0 15px 0;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		display: block;
		margin: 0;
		-webkit-transition: all 0.25s;
		-moz-transition: all 0.25s;
		transition: all 0.25s;
		border-radius: inherit;
	}

	aside ul li h3 {
		font-size: 18px;
		color: rgba(0, 0, 0, 0.5);
		font-family: sans-serif;
		padding: 5px 20px;
		display: block;
		background-color: rgba(0, 0, 0, 0.5);
	}

	aside ul li a.submenu-open:after {
		content: '';
		border: 2px solid transparent;
		border-color: var(--grey-darken-4);
		display: block;
		width: 7px;
		height: 7px;
		margin-bottom: -3px;
		position: absolute;
		bottom: 50%;
		-webkit-transform: rotate(-45deg);
		-moz-transform: rotate(-45deg);
		-ms-transform: rotate(-45deg);
		-o-transform: rotate(-45deg);
		transform: rotate(-45deg);
		border-top: none;
		border-left: none;
		right: 18px;
	}

	aside ul li a.menu-close,
	aside ul li span.menu-close {
		text-indent: 40px;
		margin-top: 0px;
	}

	aside ul li a.menu-close:before {
		content: '';
		border: 2px solid transparent;
		display: block;
		width: 7px;
		height: 7px;
		margin-bottom: -3px;
		position: absolute;
		bottom: 50%;
		-webkit-transform: rotate(-45deg);
		-moz-transform: rotate(-45deg);
		-ms-transform: rotate(-45deg);
		-o-transform: rotate(-45deg);
		transform: rotate(-45deg);
		border-right: none;
		border-bottom: none;
		left: 30px;
	}

	.menu-close {
		background-color: rgba(0, 0, 0, 0.05);
	}

	aside ul li:hover>a,
	aside ul li:hover>span,
	.sidenav li>a:hover,
	.active:hover {
		background-color: var(--grey-lighten-3) !important;
		color: var(--grey-darken-3) !important;
	}

	aside ul li:hover>a,
	aside ul li:hover>a>i,
	aside ul li:hover>span {
		color: var(--grey-darken-4) !important;
	}

	aside ul li a:hover.submenu-open:after {
		border-color: var(--grey-darken-4) !important;
	}

	aside ul li a.menu-close,
	aside ul li span.menu-close,
	aside ul li a.menu-close:before,
	aside ul li a:hover.menu-close:before {
		border-color: var(--grey-darken-1) !important;
		color: var(--grey-darken-1) !important;
	}

	.active {
		background-color: var(--red-lighten-1);
	}

	/* aside ul li:hover>a,
	aside ul li:hover>a>i, */
	aside ul li:hover>span,
	.active:hover {
		background-color: var(--red-darken-4) !important;
		color: #fff !important;
	}

	.active,
	.active i,
	.active span,
	.active:hover,
	.active:hover i,
	.active:hover span {
		color: #fff !important;
	}

	@media only screen and (min-width: 1px) and (max-width: 600px) {
		main>.main-container {
			height: calc(100vh - 140px);
		}

		nav,
		#input-search-header {
			height: 56px;
			line-height: 56px;
		}

		.navbar .profile-button span.avatar-status {
			line-height: 39px;
		}

		.navbar .nav-wrapper .navbar-list>li>a {
			padding: 0 15px;
		}

		.notification-button i {
			font-size: 29px;
			position: relative;
			top: 12px;
		}
	}

	@media only screen and (min-width: 601px) {

		nav,
		nav .nav-wrapper i,
		nav a,
		nav a.sidenav-trigger,
		nav a.sidenav-trigger i,
		#input-search-header {
			line-height: 64px;
			height: 64px;
		}
	}

	@media only screen and (max-width: 992px) {
		.progress {
			left: 0;
		}

		.sidenav {
			width: 100%;
		}

		nav ul a:hover {
			background-color: transparent;
		}

		.navbar .navbar-main {
			padding: 0 8px 0;
		}

		main {
			padding: 10px 20px;
		}

		main>.main-container {
			height: calc(100vh - 200px);
		}

		.navbar-nav {
			position: fixed;
			bottom: 0;
			z-index: 999999;
			background: var(--red-lighten-1);
			left: 0;
			right: 0;
			display: flex;
			height: 56px;
			line-height: 54px;
			place-content: space-between;
			/* margin: 0 3%; */
			margin: 0 20px;
			border-radius: 50px 50px 0 0;
			padding: 0 25px !important;
		}

		.navbar-nav li:not(.logo) a {
			border-radius: 50%;
			width: 40px;
			height: 40px;
			line-height: 0;
			padding: 0px 6px;
			color: #fff;
		}

		.navbar-nav li.logo a {
			padding: 0;
		}

		.navbar-nav li a i {
			line-height: 40px;
		}

		nav .sidenav-trigger {
			margin: 8px 0;
		}

		#page-title::before {
			display: block;
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

	@media (orientation:portrait) {
		main::before {
			background-image: url("{{ asset('assets/img/app/bg-white-portrait.jpg') }}");
		}
	}
</style>
