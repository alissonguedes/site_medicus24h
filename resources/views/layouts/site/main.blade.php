<x-app-layout>

	@if (isset($title))
		<x-slot:title>{{ $title }}</x-slot>
	@endif

	{{-- BEGIN Styles --}}
	@include('layouts.site.styles')
	{{-- END Styles --}}

	{{-- BEGIN Body --}}
	<div id="page">

		{{-- BGIN Header --}}
		@include('layouts.site.header')
		{{-- END Header --}}

		<main id="body">
			{{ $body }}
		</main>

		{{-- BEGIN Footer --}}
		@include('layouts.site.footer')
		{{-- END Footer --}}

	</div>
	{{-- END Body --}}

	{{-- BEGIN Scripts  --}}
	@include('layouts.site.scripts')
	{{-- END Scripts --}}

</x-app-layout>
