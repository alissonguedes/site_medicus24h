<!-- Compiled and minified JavaScript -->
<script src="{{ asset('assets/node_modules/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/materialize-css/dist/js/materialize.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>

<script src="{{ asset('assets/node_modules/html2canvas/dist/html2canvas.js') }}"></script>
<script src="{{ asset('assets/node_modules/mmenu-js/dist/mmenu.js') }}"></script>

<script src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script>

<script src="{{ asset('assets/js/core.js') }}"></script>
{{-- <script src="{{ asset('assets/js/menu.js') }}"></script> --}}
<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
	document.addEventListener(
		"DOMContentLoaded", () => {
			new Mmenu("#menu", {
				"offCanvas": {
					"position": "left-front"
				},
				"theme": "light",
				"iconbar": {
					"use": true,
					"top": [
						"<a href='#/'><i class='fa fa-home'></i></a>",
						"<a href='#/'><i class='fa fa-user'></i></a>"
					],
					"bottom": [
						"<a href='#/'><i class='fa fa-twitter'></i></a>",
						"<a href='#/'><i class='fa fa-facebook'></i></a>",
						"<a href='#/'><i class='fa fa-linkedin'></i></a>"
					]
				},
				"iconPanels": {
					"add": true,
					"visible": 1
				}
			});
		}
	);
</script>
