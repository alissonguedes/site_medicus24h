@php
	$days_of_week = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
	$months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
@endphp

<div id="results_horarios_reservados" class="row">

	@if (isset($results_search))
		@php
			$plural = $results_search > 0 ? $results_search . ($results_search > 1 ? ' resultados encontrados' : ' resultado encontrado') : 'nenhum resultado encontrado';
		@endphp
		@if (  isset($search))
			<div class="col s12">{{ $plural }}</div>
		@endif
	@endif

	@foreach ($agenda as $row)
		@php
			$medico = DB::connection('medicus')
			    ->table('tb_medico')
			    ->select('nome')
			    ->where('id', $row->id_medico)
			    ->first();
			$clinica = DB::connection('medicus')
			    ->table('tb_empresa')
			    ->select('titulo', 'razao_social')
			    ->where('id', $row->id_clinica)
			    ->first();
			$especialidade = DB::connection('medicus')
			    ->table('tb_especialidade')
			    ->select('especialidade')
			    ->where('id', $row->id_especialidade)
			    ->first();
			$paciente = DB::connection('medicus')
			    ->table('tb_paciente')
			    ->select('id', 'nome', 'cpf', 'sexo', 'email', 'celular')
			    ->where('id', $row->id_paciente)
			    ->first();
			// $horarios = DB::connection('medicus')
			//     ->table('tb_medico_agenda_horario')
			//     ->select('dia', 'inicio', 'fim')
			//     ->where('id_agenda', $a->id)
			//     ->where('dia', date('w', strtotime(str_replace('/', '-', $data))))
			//     ->get();

			$target = route('clinica.show-image-profile', ['paciente', $paciente->id]);

			$file = new App\Models\FileModel();
			$info = $file->getInfoFromFile($paciente->id, 'paciente');
			$img = isset($info) && getImg($target) ? $target : (!isset($paciente->sexo) || (isset($paciente->sexo) && empty($paciente->sexo)) ? asset('assets/img/avatar/avatar-0.png') : ($paciente->sexo == 'M' ? asset('assets/img/avatar/homem.png') : asset('assets/img/avatar/mulher.png')));

		@endphp
		<div class="col s12 m6 l6 xl4">
			<div class="card border grey-border border-lighten-1 z-depth-0">
				<div class="card-content">
					<div class="display-flex media">
						<a href="#" class="avatar">
							<img src="{{ $img }}" class="circle" alt="users view avatar" height="64" width="64">
						</a>
						<div class="media-body" style="padding: 0 0px 0px 30px; width: 100%; height: 136px;">
							<div class="media-heading mb-0">
								<h5 class="mb-0 mt-0" style="display: block; line-height: 23px; align-items: center; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 90%; font-weight: 300;">
									<i class="material-symbols-outlined mr-3 left" style="font-weight: 300;">person</i> {{ $paciente->nome }}
								</h5>
							</div>
							<div class="">
								@php
									$data_hora_agendada = $days_of_week[date('w', strtotime($row->data))] . ', ' . date('d \d\e', strtotime($row->data)) . ' ' . $months[date('n', strtotime($row->data)) - 1] . ' de ' . date('Y', strtotime($row->data));
								@endphp
								<span class="flex flex-center grey-text preloader skeleton--text mb-1 mt-1">
									<i class="material-symbols-outlined mr-3">credit_card</i> {{ format($paciente->cpf, 'cpf') }}
								</span>
								<span class="flex flex-center grey-text preloader skeleton--text mb-1 mt-1">
									<i class="material-symbols-outlined mr-3">event</i>
									{{ $data_hora_agendada }}
								</span>
								<span class="flex flex-center grey-text preloader skeleton--text mb-1 mt-1">
									<i class="material-symbols-outlined mr-3">schedule</i>
									{{ date('H\hi', strtotime($row->hora_agendada)) }}
								</span>
								<span class="flex flex-center grey-text preloader skeleton--text mb-0 mt-1">
									<i class="material-symbols-outlined mr-3">stethoscope</i>
									{{ $medico->nome }} · {{ $especialidade->especialidade }}
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="card-action z-depth-0" style="position: relative; height: 48px; border-top: 1px solid #ccc;">
					<div class="row">
						<div class="col s4 quick-action-btns display-flex justify-content-center align-items-center">
							<a href="#modal-detalhes-agendamento_{{ $row->id }}" class="btn-small teal darken-1 z-depth-0 waves-effect modal-trigger" data-tooltip="Detalhes" style="font-size: 22px;">
								<i class="material-symbols-outlined" style="font-weight: 300; font-size: inherit;">info</i>
							</a>
						</div>
						<div class="col s4 quick-action-btns display-flex justify-content-center align-items-center">
							<a href="#teste2" class="btn-small teal darken-1 z-depth-0 waves-effect" data-tooltip="Ver Prontuário" style="font-size: 22px;">
								<i class="material-symbols-outlined" style="font-weight: 300; font-size: inherit;">assignment_ind</i>
							</a>
						</div>
						<div class="col s4 quick-action-btns display-flex justify-content-center align-items-center">
							<a href="#teste3" class="btn-small teal darken-1 z-depth-0 waves-effect" data-tooltip="Editar Agendamento" style="font-size: 22px;">
								<i class="material-symbols-outlined" style="font-weight: 300; font-size: inherit;">edit_calendar</i>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div id="modal-detalhes-agendamento_{{ $row->id }}" class="modal modal-detalhes-agendamento">
				<div class="modal-content">
					<div class="row">
						<div class="col s12 mt-3">
							<div class="flex flex-center preloader skeleton--title">
								<span class="material-symbols-outlined mr-3">event</span>
								<h5>Detalhes do Agendamento</h5>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col s12">
							<div class="flex flex-center preloader skeleton--text mb-3 mt-3">
								<span class="material-symbols-outlined mr-3">person</span>
								<span>{{ $paciente->nome }}</span>
							</div>
							<div class="flex flex-center preloader skeleton--text mb-3 mt-3">
								<span class="material-symbols-outlined mr-3">medical_information</span>
								<span>{{ $medico->nome }}</span>
							</div>
							<div class="flex flex-center preloader skeleton--text mb-3 mt-3">
								<span class="material-symbols-outlined mr-3">stethoscope</span>
								<span>{{ $especialidade->especialidade }}</span>
							</div>
							<div class="flex flex-center preloader skeleton--text mb-3 mt-3">
								@php
									$data_hora_agendada = $days_of_week[date('w', strtotime($row->data))] . ', ' . date('d \d\e', strtotime($row->data)) . ' ' . $months[date('n', strtotime($row->data)) - 1] . ' de ' . date('Y', strtotime($row->data)) . ', ' . date('H:i', strtotime($row->hora_agendada));
								@endphp
								<span class="material-symbols-outlined mr-3">event</span>
								<span>{{ $data_hora_agendada }}</span>
							</div>
							<div class="flex flex-center preloader skeleton--text mb-3 mt-3">
								<span class="material-symbols-outlined mr-3">location_on</span>
								<span>{{ $clinica->titulo }}</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col s12">
							<div class="divider mb-3 mt-3"></div>
						</div>
					</div>
					<div class="row">
						<div class="col s12">
							<div class="flex flex-center preloader skeleton--title">
								<span class="material-symbols-outlined mr-3">contacts</span>
								<h5>Contato</h5>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col s12">
							<div class="flex flex-center preloader skeleton--text mb-3 mt-3">
								<span class="material-symbols-outlined mr-3">alternate_email</span>
								<span class="users-view-verified">{{ $paciente->email ?? 'Não informado' }}</span>
							</div>
							<div class="flex flex-center preloader skeleton--text mb-3 mt-3">
								<span class="material-symbols-outlined mr-3">phone</span>
								<span class="users-view-role">{{ $paciente->celular ?? 'Não informado' }}</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach

	<script>
		$('.modal:not(.modal.datepicker-modal.open)').modal();
	</script>

</div>
