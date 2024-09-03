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
	<main id="body" class="waiting">

		@if (isset($main))
			{{ $main }}
		@else
			<div class="card card-panel waiting no-padding no-margin">

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
					<div {{ $forms->attributes->merge([
					    'id' => 'formularios',
					    'class' => 'card-reveal no-padding',
					    'style' => ($errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);') . 'overflow:hidden; z-index: 9999999;',
					]) }}>
						{{ $forms }}
					</div>
				@endif

				@if (isset($footer))
					{{ $footer }}
				@endif
				@if (isset($form_delete))
					<div {{ $form_delete->attributes->merge([
					    'id' => 'modal-delete',
					    'class' => '',
					]) }}>
						<form {{ $form_delete->attributes->merge([
						    'action' => '#',
						    'method' => 'post',
						    'class' => 'card gradient-45deg-teal-teal z-depth-4 confirm_delete',
						    'style' => 'width: 400px; margin: auto; position: absolute; left: 50%; margin-left: -200px; margin-right: -200px; border-radius: 24px; z-index: 99999999999999999999999;',
						]) }}>
							<div class="card-content white-text">
								{{ $form_delete }}
							</div>
							<div class="card-action" style="position: relative;">
								@csrf
								<input type="hidden" name="_method" value="delete">
								<input type="hidden" name="id">
								<button type="reset" id="cancel" class="btn white black-text waves-effect modal-close left">Cancelar</button>
								<button type="submit" id="confirm" class="btn red waves-effect right" style="align-items: center; display: flex; background-color: var(--red) !important;">Confirmar</button>
								<div class="clearfix"></div>
							</div>
						</form>
					</div>
					<style>
						#modal-delete {
							display: none;
						}

						#modal-delete.open {
							display: block;
						}

						div#modal-delete::after {
							content: '';
							position: absolute;
							top: 0;
							bottom: 0;
							background: rgba(0, 0, 0, 0.3);
							left: 0;
							right: 0;
							z-index: 999999999;
						}
					</style>
				@endif

				@if (isset($action))
					<div {{ $form_delete->attributes->merge([
					    'id' => 'info',
					    'class' => 'card-action',
					    'style' => 'font-size: 13px;',
					]) }}>
						{{ $action }}
					</div>
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
