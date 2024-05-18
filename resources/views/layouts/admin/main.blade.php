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

			@if (isset($main))
				{{ $main }}
			@else
				<div class="card no-padding no-margin">

					@if (isset($header))
						<section>
							<header class="z-depth-0 border-bottom">
								{{ $header }}
							</header>
						</section>
					@endif

					<div class="card-content scroller">
						@if (isset($body))
							{{ $body }}
						@endif
					</div>

					@if (isset($form))
						<form {{ $form->attributes->merge(['class' => 'card-reveal no-padding']) }}>

							@if (isset($form_tabs))
								<div {{ $form_tabs->attributes->merge(['class' => 'card-tabs']) }}>
									{{ $form_tabs }}
								</div>
							@endif

							<div class="card-content pl-1 pr-1 scroller">
								{{ $form }}
							</div>

							@if (isset($card_footer))
								<div {{ $card_footer->attributes->merge(['class' => 'card-action right-align']) }}>
									{{ $card_footer }}
								</div>
							@endif

						</form>
					@endif

					@if (isset($footer))
						{{ $footer }}
					@endif

				</div>

			@endif

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
