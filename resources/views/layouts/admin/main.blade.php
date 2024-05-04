<x-app-layout>

	@if (isset($title))
		<x-slot:title>{{ $title }}</x-slot:title>
	@endif

	{{-- BEGIN Styles --}}
	<x-slot:styles>
		@include('layouts.admin.styles')
	</x-slot:styles>
	{{-- END Styles --}}

	{{-- BEGIN #Page --}}
	<div id="page">

		{{-- BGIN Header --}}
		@include('layouts.admin.header')
		{{-- END Header --}}

		{{-- BGIN Sidebar --}}
		@include('layouts.admin.sidebar')
		{{-- END Sidebar --}}

		{{-- BEGIN Body --}}
		<main id="body">
			<div class="main-container">
				{{ $body }}
			</div>
		</main>
		{{-- END Body --}}

		{{-- BEGIN Footer --}}
		@include('layouts.admin.footer')
		{{-- END Footer --}}

	</div>
	{{-- END #Page --}}

	{{-- BEGIN Scripts  --}}
	<x-slot:scripts>

		@include('layouts.admin.scripts')

		@if (isset($script))
			{{ $script }}
		@endif

	</x-slot:scripts>
	{{-- END Scripts --}}

</x-app-layout>
