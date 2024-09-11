{{-- <img src="{{ asset('assets/img/logo/logo.png') }}" alt=""> --}}

<div class="logo">
	<div class="icon"></div>
	<div class="text">
		<span>Clinic</span>
		<small>Cloud</small>
	</div>
</div>

<style>
	.logo {
		position: relative;
		overflow: hidden;
		width: 150px;
		height: 50px;
		line-height: 50px;
		display: flex;
		align-items: center;
	}

	.logo .icon {
		display: flex;
		height: inherit;
		line-height: inherit;
	}

	.logo .icon:before {
		content: 'cloud';
		font-family: 'Material Symbols Outlined';
		position: relative;
		font-size: 45px;
		/* transform: rotateY(180deg); */
	}

	.logo {
		font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
		color: var(--gradient-45deg-purple-deep-purple) !important;
	}

	.logo .text {
		font-size: 24px;
		display: block;
		position: relative;
		margin-left: 5px;
	}

	.logo .text span {
		top: -3px;
		position: relative;
	}

	.logo .text small {
		position: absolute;
		left: 18px;
		bottom: -10px;
		font-size: 8px;
		letter-spacing: 1px;
	}

	.logo .text small,
	.logo .text span {
		display: block;
	}
</style>
