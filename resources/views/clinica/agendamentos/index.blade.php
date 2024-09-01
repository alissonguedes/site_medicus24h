<x-clinica-layout>

	<x-slot:icon> edit_calendar </x-slot:icon>
	<x-slot:title> Agenda Médica </x-slot:title>

	<x-slot:main>

		<div class="card card-panel no-padding">

			<div class="card-content animated fadeIn">

				<div class="row">
					<div class="col s12 m6 l5">
						<div class="calendar_pk" data-url="{{ route('clinica.agendamentos.agenda') }}"></div>
					</div>
					<div class="col s12 m6 l7">
						<h5 for="f_medico" class="no-margin flex flex-center">
							<i class="material-symbols-outlined mr-1" style="font-size: 32px; line-height: 32px; ">filter_alt</i> Filtros
						</h5>
						<div class="input-field">
							<select name="medico" id="f_medico" class="autocomplete" data-url="{{ route('clinica.recursosmedicos.agenda.busca.medico_especialidade') }}" placeholder="Buscar por médico ou especialidade"></select>
						</div>
					</div>
				</div>

			</div>

			@include('clinica.agendamentos.includes.scripts')

	</x-slot:main>

</x-clinica-layout>
