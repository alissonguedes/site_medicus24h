<x-clinica-layout>

	<x-slot:icon> real_estate_agent </x-slot:icon>
	<x-slot:title> HomeCare </x-slot:title>

	<x-header-page>
		<x-slot:search data-url="{{ route('clinica.homecare.pacientes.search') }}" placeholder="Pesquisar pacientes..."></x-slot:search>
		<x-slot:add_button data-href="{{ route('clinica.homecare.pacientes') }}" data-tooltip="Incluir Paciente">add</x-slot:add_button>
	</x-header-page>

	<x-slot:body>

		<div class="row">
			@if (isset($pacientes) && $pacientes->count() > 0)

				@php
					$programaModel = new App\Models\Clinica\ProgramaModel();
				@endphp
				@foreach ($pacientes as $row)
					<div class="col s12 m3 l3">
						<div class="card">
							<div class="card-image">

								@php
									if (!isset($row->status) || (isset($row->status) && $row->status === '0')):
									    $style = 'opacity: 0.6; filter: grayscale(1)';
									endif;
									$target = route('clinica.show-image-profile', ['row', $row->id]);
									$img = !getImg($target) ? (!isset($row->sexo) || (isset($row->sexo) && empty($row->sexo)) ? asset('assets/img/avatar/avatar-0.png') : ($row->sexo == 'M' ? asset('assets/img/avatar/homem.png') : asset('assets/img/avatar/mulher.png'))) : $target;
								@endphp

								<img src="{{ $img }}" class="" alt="">

								{{-- <span class="card-title white-text m-0" style="background-color: rgba(0, 0, 0, 0.3); width: 100%;">{{ $row->nome }}</span> --}}
								<button class="btn-floating halfway-fab waves-effect waves-light red" data-trigger="form" data-target="main-form" data-href="{{ route('clinica.homecare.pacientes.edit', $row->id) }}" style="z-index: 9999999"><i class="material-icons">edit</i></button>
							</div>

							<div class="card-action white-text" style="position: relative;">
								@php
									$programas = $programaModel
									    ->select('titulo')
									    ->from('tb_paciente_programa AS PP')
									    ->join('tb_programas AS P', 'P.id', 'PP.id_programa')
									    ->where('id_paciente', $row->id)
									    ->get();
								@endphp
								{{-- <button type="button" class="btn btn-flat btn-floating activator amber-text">
									<i class="material-symbols-outlined">stars</i>
								</button> --}}
								<a href="#" style="text-overflow: ellipsis; white-space: nowrap; display: block; overflow: hidden;">{{ $row->nome }}</a>
							</div>

							@if (isset($programas) && $programas->count() > 0)
								<div class="card-reveal">
									<div class="card-title">Programas <i class="material-symbols-outlined right">close</i></div>
									@foreach ($programas as $key => $value)
										<p>{{ $value->titulo }}</p>
									@endforeach
								</div>
							@endif
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

{{-- <div class="col s12 m4">
	<div class="card horizontal flex flex-center pl-5">

		<div class="card-image" style="max-width: 20%; min-width: 20%;">

			@php
				if (!isset($paciente->status) || (isset($paciente->status) && $paciente->status === '0')):
					$style = 'opacity: 0.6; filter: grayscale(1)';
				endif;
				$target = route('clinica.show-image-profile', ['paciente', $paciente->id]);
				$img = !getImg($target) ? (!isset($paciente->sexo) || (isset($paciente->sexo) && empty($paciente->sexo)) ? asset('assets/img/avatar/avatar-0.png') : ($paciente->sexo == 'M' ? asset('assets/img/avatar/homem.png') : asset('assets/img/avatar/mulher.png'))) : $target;
			@endphp

			<img src="{{ $img }}" class="" style="border-radius: 50%; width: 50px; height: 50px;" alt="">

		</div>

		<div class="card-stacked">

			<div class="card-content white-text pl-2" style="min-height: 130px; height: auto">
				<h6 class="white-text" style="">{{ $paciente->nome }}</h6>
				<p>teste</p>
				<p>teste</p>
				<p>teste</p>
			</div>

			<div class="card-action no-order p-0 pt-2 pb-2 right-align">
				<button type="button" class="btn btn-flat btn-floating amber-text waves-effect activator" data-tooltip="Abrir um Ticket" data-trigger="form" data-target="form-ticket" data-href="{{ route('clinica.homecare.pacientes.tickets') }}">
					<i class="material-symbols-outlined">confirmation_number</i>
				</button>
				<button type="button" class="btn btn-flat btn-floating amber-text waves-effect" data-tooltip="Abrir um Ticket">
					<i class="material-symbols-outlined">visibility</i>
				</button>
			</div>

		</div>

	</div>
</div> --}}
