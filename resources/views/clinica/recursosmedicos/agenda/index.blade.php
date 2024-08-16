<x-clinica-layout>

	<x-slot:icon> edit_calendar </x-slot:icon>
	<x-slot:title> Agenda Médica </x-slot:title>

	<x-slot:main>

		<div class="card card-panel no-padding">

			<div class="card-header animated fadeIn">
				@include('clinica.recursosmedicos.agenda.includes.card-header')
			</div>

			{{-- @php
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
				                    // 'startTime'=> $h,
				                    // 'endTime'=> $h
				                ];
				            }
				        }
				    }
				}
			@endphp --}}

			<div class="card-content animated fadeIn">

				@php

					$profissionais = new App\Models\Clinica\AgendaModel();

					$medicos = $profissionais->select('*')->from('tb_medico AS M')->join('tb_funcionario AS F', 'F.id', 'M.id_funcionario')->get();

				@endphp

				@if (isset($medicos) && $medicos->count() > 0)
					<table class="">
						<thead>
							<tr>
								<th class="center-align">Nome</th>
								<th class="center-align">Conselho</th>
								<th class="center-align">Especialidade</th>
								<th class="center-align"></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($medicos as $medico)
								@php
									$especialidade = $profissionais
									    ->select('especialidade')
									    ->from('tb_especialidade')
									    ->where('id', function ($query) use ($medico) {
									        $query
									            ->select('id_especialidade')
									            ->from('tb_medico_especialidade')
									            ->where('id_funcionario', $medico->id_funcionario);
									    })
									    ->first();
								@endphp
								<tr>
									<td> {{ $medico->nome }} </td>
									<td> {{ $medico->crm }} </td>
									<td> {{ $especialidade->especialidade }} </td>
									<td class="center-align">
										<button class="btn btn-flat transparent btn-floating black-text ml-3" data-href="{{ route('clinica.recursosmedicos.agenda.medico', $medico->id) }}" data-tooltip="Ver Agenda">
											<i class="material-symbols-outlined">view_agenda</i>
										</button>
										<button class="btn btn-flat transparent btn-floating black-text ml-3" data-href="{{ route('clinica.recursosmedicos.agenda.disponibilidade', $medico->id) }}" data-tooltip="Adicionar Disponibilidade" data-trigger="form" data-target="main-form">
											<i class="material-symbols-outlined">edit_calendar</i>
										</button>
										<button class="btn btn-flat transparent btn-floating black-text ml-3" data-href="{{ route('clinica.recursosmedicos.agenda.medico.agendamento', $medico->id) }}" data-tooltip="Agendamento" data-trigger="form" data-target="form-agendamento">
											<i class="material-symbols-outlined">calendar_add_on</i>
										</button>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@endif

			</div>

			<div id="formularios" class="card-reveal no-padding" style="{{ ($errors->any() || request()->routeIs('clinica.recursosmedicos.agenda.disponibilidade') || request()->routeIs('clinica.recursosmedicos.agenda.medico.agendamento') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);') . 'overflow:hidden; z-index: 9999999;' }}">
				@include('clinica.recursosmedicos.agenda.includes.main-form')
			</div>

		</div>

		@include('clinica.recursosmedicos.agenda.includes.scripts')

	</x-slot:main>

</x-clinica-layout>
