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
		$('#toast-container').fadeOut(1000);
		setTimeout(function() {
			$('#toast-container').remove();
		}, 1500)
	}, 10000)
</script>

<style>
	#toast-container {
		top: auto;
		right: auto;
		left: 20px;
		bottom: 20px;
		z-index: 9999999;
	}
</style>
