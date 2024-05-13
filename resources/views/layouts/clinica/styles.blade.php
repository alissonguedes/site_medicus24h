<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="{{ asset('assets/node_modules/materialize-css/dist/css/materialize.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/node_modules/perfect-scrollbar/css/perfect-scrollbar.css') }}">
<link rel="stylesheet" href="{{ asset('assets/node_modules/@splidejs/splide/dist/css/splide.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/node_modules/pace-js/pace-theme-default.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/node_modules/froala-editor/css/froala_editor.pkgd.min.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/styles/materializecss.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/defaults/materialize.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/defaults/fonts.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/defaults/colors.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/defaults/animate.css') }}">

<link rel="stylesheet" href="{{ asset('assets/styles/clinica.css') }}">

<style>
	/*
	aside {
		position: fixed;
		top: 0;
		height: 100%;
		background-color: #ffffff;
		z-index: 9999999;
		overflow: hidden;
	}
	*/
	/*
	aside ul {
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		padding-top: 0;
		padding-bottom: 20px;
		height: 100%;
		background-color: #fff;
		transform: translate(100%, 0);
		transition: transform 0.6s ease;
		-webkit-transition: -webkit-transform 0.5s ease;
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

	.main-menu {
		height: calc(100% - 64px);
		position: relative;
		width: 100%;
		overflow: hidden;
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
	} */
	/*
	*/
</style>
