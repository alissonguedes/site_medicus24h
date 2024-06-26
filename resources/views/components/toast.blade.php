<div id="toast-container">
	<div {{ $attributes->merge([
	    'class' => 'toast animated fadeIn z-depth-3 white-text',
	    'style' => 'top: 0px; opacity: 1;',
	]) }}>
		{{-- <span>I am toast content</span> --}}
		{{-- <button class="btn-flat toast-action">Undo</button> --}}
		{{ $slot }}
	</div>
</div>

<script>
	setTimeout(function() {
		// $('#toast-container').fadeOut(1000);
		$('#toast-container').animate({
			marginRight: '-100%',
			'opacity': 0,
		}, {
			complete: () => {
				$('#toast-container').remove();
			}
		}, 2000);
	}, 5000)
</script>

<style>
	#toast-container {
		top: 40px;
		right: 30px;
		z-index: 9999999;
	}
</style>
