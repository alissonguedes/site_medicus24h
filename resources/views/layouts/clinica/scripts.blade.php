<script>
	var BASE_URL = "{{ base_url() }}";
	var BASE_PATH = "{{ asset('/') }}";
	var SITE_URL = "{{ site_url() }}";
	var SITE_KEY = "{{ env('INVISIBLE_RECAPTCHA_SITEKEY') }}";
</script>

<script src="{{ asset('assets/js/menu.js') }}"></script>
<script src="{{ asset('assets/js/core.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
