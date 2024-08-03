<x-clinica-layout>

	<x-slot:icon> real_estate_agent </x-slot:icon>
	<x-slot:title> HomeCare </x-slot:title>

	<x-header-page>
		<x-slot:search href="{{ route('clinica.pacientes.search') }}" placeholder="Pesquisar pacientes..."></x-slot:search>
		<x-slot:add_button data-href="{{ route('clinica.homecare.pacientes') }}" data-target="main-form">add</x-slot:add_button>
	</x-header-page>

	<x-slot:body>

		<div class="row">
			@if (isset($pacientes) && $pacientes->count() > 0)

				@foreach ($pacientes as $paciente)
					<div class="col s12 m4">
						<div class="card horizontal">

							<div class="card-image circle">

								@php

									if (!isset($paciente->status) || (isset($paciente->status) && $paciente->status === '0')):
									    $style = 'opacity: 0.6; filter: grayscale(1)';
									endif;

									$target = route('clinica.show-image-profile', ['paciente', $paciente->id]);

									$img = !getImg($target) ? (!isset($paciente->sexo) || (isset($paciente->sexo) && empty($paciente->sexo)) ? asset('assets/img/avatar/avatar-0.png') : ($paciente->sexo == 'M' ? asset('assets/img/avatar/homem.png') : asset('assets/img/avatar/mulher.png'))) : $target;
								@endphp

								<img src="{{ $img }}" class="" alt="">

							</div>

							<div class="card-stacked">

								<div class="card-content white-text pl-0">
									<h5 class="white-text" style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 50%;">{{ $paciente->nome }}</h5>
								</div>

								<div class="card-action no-border pl-0">
									<button type="button" class="btn btn-flat btn-floating amber-text mr-2 waves-effect activator" data-tooltip="Abrir um Ticket" data-trigger="form" data-target="form-ticket" data-href="{{ route('clinica.homecare.pacientes.tickets') }}">
										<i class="material-symbols-outlined">confirmation_number</i>
									</button>
									<button type="button" class="btn btn-flat btn-floating amber-text mr-2 waves-effect" data-tooltip="Abrir um Ticket">
										<i class="material-symbols-outlined">visibility</i>
									</button>
								</div>

							</div>

						</div>
					</div>
				@endforeach
				<style>
					.card.horizontal .card-image.circle {
						padding: 4% !important;
					}
				</style>
			@else
				<div class="col s12">
					Nenhum paciente cadastrado nesta modalidade.
				</div>
			@endif
		</div>

	</x-slot:body>

	@include('clinica.homecare.pacientes.includes.form')

</x-clinica-layout>
