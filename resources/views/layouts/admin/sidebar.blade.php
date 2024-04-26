<aside>

	<button type="button" class="btn-menu btn-floating waves-effect z-depth-0"><i
			class="material-symbols-outlined teal-text text-lighten-1">menu</i></button>

	<div class="application-logo">
		<a href="{{ route('admin.index') }}">
			<x-application-logo />
		</a>
	</div>

	@include('admin.navigation')

</aside>

<style>
	header {
		position: relative;
		border-bottom: 5px solid #acece6;
	}

	header nav {
		padding-left: 300px;
	}

	.navbar-color {
		color: #777777;
		background-color: #fff;
	}

	/* .navbar-main {
		border-bottom: 5px solid #acece6;
	} */

	nav ul li,
	nav ul li a,
	nav ul li i {
		color: inherit;
	}

	nav ul li {
		border-left: 1px solid #acece655;
	}

	nav ul li:first-child {
		border-left: none;
	}

	nav,
	nav .nav-wrapper i,
	nav a.sidenav-trigger,
	nav a.sidenav-trigger i {
		height: 59px;
		line-height: 58px;
	}

	.progress {
		position: absolute;
		height: 5px;
		bottom: -20px;
		left: 300px;
		width: calc(100% - 300px);
		z-index: 999999;
		border-radius: 0;
		display: none;
	}

	.btn-menu {
		position: absolute;
		z-index: 999999;
		top: 10px;
		left: 10px;
	}

	.btn-menu,
	.btn-menu:hover,
	.btn-menu:focus {
		background-color: transparent !important;
	}

	.application-logo {
		padding: 0px 18px;
		/* background-color: #262a33;
		border-bottom: 5px #191c21 solid; */
		background-color: #ffffff;
		border-bottom: 5px solid var(--teal-lighten-1);
		float: left;
		height: 69px;
		position: relative;
		text-align: center;
		width: inherit;
		display: block;
		z-index: 5;
		padding: 10px 0;
	}

	.application-logo:after {
		content: '';
		position: absolute;
		top: 0;
		right: 0;
		left: auto;
		bottom: 0;
		width: 1px;
		background-color: #acece655;
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
		width: 300px;
		background: #101215;
		color: rgba(255, 255, 255, 0.6);
		z-index: 999999;
		overflow: hidden;
	}

	aside ul {
		position: absolute;
		top: 50px;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: inherit;
		transform: translate(110%, 0);
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
	}

	aside ul li:after {
		width: auto;
		position: relative;
		left: auto;
	}

	aside ul li::after {
		content: '';
		display: block;
		width: 100%;
		position: absolute;
		bottom: 0;
		left: 0;
		height: 1px;
		background: rgba(0, 0, 0, 0.3);
	}

	aside ul li a,
	aside ul li .material-symbols-outlined {
		font-size: 16px;
		line-height: 3rem;
	}

	aside ul li a,
	aside ul li span {
		display: block !important;
		padding: 0 15px 0;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		color: inherit;
		display: block;
		margin: 0;
		-webkit-transition: all 0.25s;
		-moz-transition: all 0.25s;
		transition: all 0.25s;
	}

	.menu-close {
		background: rgba(0, 0, 0, 0.1);
		color: rgba(255, 255, 255, 0.3);
	}

	aside ul li:hover>a,
	aside ul li:hover>span {
		background: rgba(0, 0, 0, 0.1);
	}

	.active {
		background-color: #000;
		color: #fff;
	}

	main {
		display: block;
		padding-left: 300px;
		background-color: #ebebeb;
		height: calc(100vh - 64px);
	}
</style>
