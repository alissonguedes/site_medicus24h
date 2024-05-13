<script>
	var BASE_URL = "{{ base_url() }}";
	var BASE_PATH = "{{ asset('/') }}";
	var SITE_URL = "{{ site_url() }}";
	var SITE_KEY = "{{ env('INVISIBLE_RECAPTCHA_SITEKEY') }}";
</script>

<!-- Compiled and minified JavaScript -->
<script src="{{ asset('assets/node_modules/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/materialize-css/dist/js/materialize.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/@splidejs/splide/dist/js/splide.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/pace-js/pace.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>

<script src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script>

<script src="{{ asset('assets/scripts/menu.js') }}" defer></script>
<script src="{{ asset('assets/scripts/app/clinica/core.js') }}" defer></script>

<script>
	// loadScripts();
	// $(function() {

	// 	$('.slider').slider();
	// 	$('.scrollspy').scrollSpy({
	// 		scrollOffset: 100,
	// 	});

	// 	$('#btn-menu').unbind().bind('click', function() {
	// 		if ($('#menu-nav').is(':visible')) {
	// 			$('#menu-nav').slideUp();
	// 		} else {
	// 			$('#menu-nav').slideDown();
	// 		}
	// 	});

	// 	$('#menu-nav').find('li a').unbind().bind('click', function() {
	// 		$('#menu-nav li a').removeClass('active');
	// 		if ($(window).width() <= 1230)
	// 			$(this).parents('#menu-nav').slideUp();
	// 	});

	// 	$(window).resize(function() {
	// 		if ($(this).width() > 1230)
	// 			$('#menu-nav').show();
	// 	});

	// })
</script>
