<x-clinica-layout>

	<x-slot:icon data-href="{{ route('clinica.recursosmedicos.agenda.index') }}">arrow_back</x-slot:icon>
	<x-slot:title>Agenda Médica</x-slot:title>

	<x-header-page>
		{{-- <x-slot:search data-url="{{ route('clinica.pacientes.search') }}" placeholder="Pesquisar pacientes..."></x-slot:search> --}}
		<x-slot:add_button data-href="{{ route('clinica.recursosmedicos.agenda.medico', request('id_medico')) }}" data-tooltip="Adicionar Paciente" style="position: absolute; right: 20px;" data-trigger="form" data-target="main-form">add</x-slot:add_button>
	</x-header-page>

	<x-slot:body>

		<div class="row">
			<div class="col s12">
				<h5>Horários de atendimento: {{ $medico->nome }}</h5>
			</div>
		</div>

		<br>

		<div class="row">
			<div class="col s12 m6 l4">
				<div class="input-field">
					<label for="clinica" class="active">Filtrar por clínica:</label>
					<select name="clinica" id="clinica">
						<option value="*">Todas as clínicas</option>
						@php
							$clinicaModel = new App\Models\Clinica\ClinicaModel();

							$empresas = $clinicaModel
							    ->from('tb_medico_clinica AS M')
							    ->join('tb_empresa AS E', 'E.id', 'M.id_empresa')
							    ->where('M.id_medico', $medico->id)
							    ->orderBy('E.razao_social', 'asc')
							    ->get();

						@endphp
						@if (isset($empresas) && $empresas->count() > 0)
							@foreach ($empresas as $e)
								<option value="{{ $e->id }}">{{ $e->razao_social }}</option>
							@endforeach
						@endif
					</select>
				</div>
			</div>
		</div>

		{{-- @if (isset($agenda) && $agenda->count() > 0)
					@php
						// $agenda_medica = [];

						// if (isset($agenda)) {
						//     $id = $agenda->id;
						//     $id_medico = $agenda->id_medico;
						//     $medico = DB::connection('medicus')->table('tb_medico AS M')->select('nome')->where('M.id', $id_medico)->first();
						//     $horarios = json_decode($agenda->horarios, true);

						//     if ($horarios) {
						//         foreach ($horarios as $dia => $hora) {
						//             $agenda_medica[] = [
						//                 'groupId' => $id_medico,
						//                 'daysOfWeek' => [$dia],
						//                 'title' => $medico->nome,
						//                 // 'startTime' => array_keys($hora)[0],
						//                 // 'endTime' => array_values($hora)[0],
						//             ];
						//         }
						//     }
						// }
					@endphp
				@else
					<p>Ainda não foram informados os horários disponíveis para este médico. <a href="#">Cadastrar Agenda</a></p>
				@endif --}}

		@for ($i = 0; $i < 3; $i++)
			<div class="row">
				<div class="col s12">
					<h5 class="bold">Nome da empresa</h5>
				</div>
			</div>

			@for ($i = 0; $i < 10; $i++)
				<div class="row">
					<div class="col s4 m4 l4">Segunda-feira</div>
					<div class="col s4 m4 l4">08:00-11:00</div>
					<div class="col s4 m4 l4">13:00-17:00</div>
				</div>
			@endfor

		@endfor

	</x-slot:body>

	@include('clinica.recursosmedicos.agenda.includes.form')

</x-clinica-layout>
