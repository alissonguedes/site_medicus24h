<x-clinica-layout>

	<x-slot:icon data-href="{{ route('clinica.recursosmedicos.agenda.index') }}"> arrow_back </x-slot:icon>
	<x-slot:title> Agenda Médica </x-slot:title>

	<x-slot:main>

		<div class="card card-panel no-padding">

			<div class="card-header animated fadeIn">
				@include('clinica.recursosmedicos.agenda.includes.card-header')
			</div>

			@php
				$agenda_medica = [];
				if (isset($horarios)) {
				    foreach ($horarios as $agenda) {
				        $id = $agenda->id;
				        $id_medico = $agenda->id_medico;
				        $medico = DB::connection('medicus')->table('tb_medico AS M')->select('nome')->join('tb_funcionario AS F', 'F.id', 'M.id_funcionario')->where('M.id_funcionario', $id_medico)->first();
				        $horarios = json_decode($agenda->horarios, true);
				        if ($horarios) {
				            foreach ($horarios as $dia => $hora) {
				                $agenda_medica[] = [
				                    'groupId' => $id_medico,
				                    'daysOfWeek' => [$dia],
				                    'title' => $medico->nome,
				                    'startTime' => array_keys($hora)[0],
				                    'endTime' => array_values($hora)[0],
				                ];
				            }
				        }
				    }
				}
			@endphp

			<div class="card-content animated fadeIn no-padding">
				<div id="calendar"></div>
			</div>

			<div id="formularios" class="card-reveal no-padding" style="{{ ($errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);') . 'overflow:hidden; z-index: 9999999;' }}">
				@include('clinica.recursosmedicos.agenda.includes.main-form')
			</div>

		</div>

		@include('clinica.recursosmedicos.agenda.includes.scripts')

	</x-slot:main>

</x-clinica-layout>
