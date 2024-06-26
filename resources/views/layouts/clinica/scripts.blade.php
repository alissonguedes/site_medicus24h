{{-- <!-- Compiled and minified JavaScript -->
<script src="{{ asset('assets/node_modules/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/materialize-css/dist/js/materialize.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>

<script src="{{ asset('assets/node_modules/html2canvas/dist/html2canvas.js') }}"></script>
<script src="{{ asset('assets/node_modules/mmenu-js/dist/mmenu.js') }}"></script>

<script src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script>

<script src="{{ asset('assets/js/core.js') }}"></script>
<script src="{{ asset('assets/js/menu.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script> --}}

<script>
	var BASE_URL = "{{ base_url() }}";
	var BASE_PATH = "{{ asset('/') }}";
	var SITE_URL = "{{ site_url() }}";
	var SITE_KEY = "{{ env('INVISIBLE_RECAPTCHA_SITEKEY') }}";
</script>

<!-- Compiled and minified JavaScript -->
<script src="{{ asset('assets/node_modules/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/materialize-css/dist/js/materialize.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>

<script src="{{ asset('assets/node_modules/html2canvas/dist/html2canvas.js') }}"></script>
<script src="{{ asset('assets/node_modules/mmenu-js/dist/mmenu.js') }}"></script>

<script src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script>

@stack('scripts')

<script src="{{ asset('assets/js/menu.js') }}"></script>
<script src="{{ asset('assets/js/core.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
