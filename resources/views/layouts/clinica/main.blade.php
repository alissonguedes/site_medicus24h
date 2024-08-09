<x-app-layout>

	@if (isset($title))
		<x-slot:title>{{ $title }}</x-slot:title>
	@endif

	{{-- BEGIN Styles --}}
	@push('styles')
		@include('layouts.clinica.styles')
	@endpush
	{{-- END Styles --}}

	{{-- BGIN Header --}}
	@include('layouts.clinica.header')
	{{-- END Header --}}

	{{-- BGIN Sidebar --}}
	@include('layouts.clinica.sidebar')
	{{-- END Sidebar --}}

	{{-- BEGIN Body --}}
	<main id="body" class="">

		@if (isset($main))
			{{ $main }}
		@else
			<div class="card card-panel no-padding no-margin">

				@if (isset($header))
					<section class="card-header">
						{{ $header }}
					</section>
				@endif

				<div class="card-content">

					@if (isset($body))
						{{ $body }}
					@endif

				</div>

				<style>
					div.confirm_delete {
						position: absolute;
						top: 0;
						bottom: 0;
						left: 0;
						right: 0;
						opacity: 0;
						display: none;
						transition: 200ms;
						z-index: 999999;
					}

					div.confirm_delete::before,
					div.confirm_delete::after {
						content: '';
						background-color: rgba(0, 0, 0, 0.2);
						transform: opacity(0.1);
						position: absolute;
						top: 0;
						left: 0;
						right: 0;
						bottom: 0;
						z-index: 999999;
					}

					div.confirm_delete.open {
						opacity: 1;
						transform: translateY(0%);
						display: block;
					}

					.confirm_delete .card {
						position: absolute;
						bottom: 0;
						z-index: 9999999;
						top: 50%;
						bottom: auto;
						left: 50%;
						width: 380px;
						height: 205px;
						margin-top: -115px;
						margin-left: -190px;
					}

					.confirm_delete .card .card-footer {
						position: absolute;
						bottom: 0;
						left: 0;
						right: 0;
					}
				</style>

				@if (isset($forms))
					<div id="formularios" class="card-reveal no-padding" style="{{ ($errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);') . 'overflow:hidden; z-index: 9999999;' }}">
						{{ $forms }}
					</div>
				@endif

				@if (isset($footer))
					{{ $footer }}
				@endif

			</div>

		@endif

		@if (count($errors) > 0)
			<x-toast class="red darken-2">Existem erros no formulário!</x-toast>
		@endif

		@if (session('message'))
			<x-toast class="green darken-4">{{ session('message') }}</x-toast>
		@endif

	</main>
	{{-- END Body --}}

	{{-- BEGIN Footer --}}
	@include('layouts.clinica.footer')
	{{-- END Footer --}

	{{-- BEGIN Scripts --}}
	@push('scripts')
		@include('layouts.clinica.scripts')
	@endPush
	{{-- END Scripts --}}

</x-app-layout>
