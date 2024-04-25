<x-app-layout>

	@if (isset($title))
		<x-slot:title>{{ $title }}</x-slot>
	@endif

	{{-- BEGIN Styles --}}
	<x-slot:styles>
		@include('layouts.site.styles')
	</x-slot:styles>
	{{-- END Styles --}}

	{{-- BEGIN Body --}}
	<div id="body">

		{{-- BGIN Header --}}
		<x-slot:header>
			@include('layouts.site.header')
		</x-slot:header>
		{{-- END Header --}}

		{{ $slot }}

		{{-- BEGIN Footer --}}
		<x-slot:footer>
			@include('layouts.site.footer')
		</x-slot:footer>
		{{-- END Footer --}}

	</div>
	{{-- END Body --}}

	{{-- BEGIN Scripts  --}}
	<x-slot:scripts>

		@include('layouts.site.scripts')

		@if (isset($script))
			{{ $script }}
		@endif

	</x-slot:scripts>
	{{-- END Scripts --}}

</x-app-layout>
