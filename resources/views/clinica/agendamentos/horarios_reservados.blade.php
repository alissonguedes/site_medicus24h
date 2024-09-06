@php
	$meses = ['Janeiro', 'Fevereiro', 'Março', 'Maio', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
	$days_of_week = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
	$months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

	$regex = preg_match('/^(\d){4}\-(([0]?)[0-9]|[1][0-2])\-([0-2][0-9]|[3][0-1])$/', $data);
	$datastr = $regex ? 'dia ' . date('d', strtotime($data)) . ' de ' . $meses[date('n', strtotime($data))] . ' de ' . date('Y', strtotime($data)) : 'mês de ' . $meses[date('n', strtotime($data))] . ' de ' . date('Y', strtotime($data));
@endphp

<div class="row">
	<div class="col s12">
		<h4 class="mb-2">Agendamentos para o {{ $datastr }}</h4>
	</div>
</div>

<script>
	$(function() {
		$('.dropdown-trigger').dropdown({
			coverTrigger: false,
			constrainWidth: false,
			alignment: 'right',
		});
	});
</script>
<div class="row mb-2">
	<div class="col s6 right-align">
		<div class="input-field prefix mt-0 mb-0">
			<label for="search" class="material-symbols-outlined prefix" style="-webkit-transform: unset; -ms-transform: unset; transform: none; -webkit-transform-origin: unset; -ms-transform-origin: unset; transform-origin: unset;">search</label>
			<input type="search" id="search" style="padding-left: 40px;" placeholder="Buscar por médico, especialidade, clínica ou paciente">
		</div>
	</div>
	<div class="col s6 right-align">
		<a type="button" class="btn dropdown-trigger grey grey-text text-darken-4 lighten-5 border z-depth-0 waves-effect" data-target="dropdown1">
			<i class="material-symbols-outlined left">sort</i>
			<span>Data e Hora</span>
		</a>
		<ul id="dropdown1" class="dropdown-content">
			<li><a href="#!"><i class="material-symbols-outlined">event</i>Data e Hora</a></li>
			<li><a href="#!"><i class="material-symbols-outlined">medical_information</i>Médico</a></li>
			<li><a href="#!"><i class="material-symbols-outlined">stethoscope</i>Especialidade</a></li>
			<li><a href="#!"><i class="material-symbols-outlined">location_on</i>Clínica</a></li>
			<li><a href="#!"><i class="material-symbols-outlined">person</i>Paciente</a></li>
		</ul>
	</div>
</div>

@if ($agenda->count() > 0)

	<div class="row">

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
			<div class="col s12 m6 l4">
				<div class="section users-view">
					<div class="card">
						<div class="card-content">
							<div class="row">
								<div class="col s12">
									<div class="display-flex media">
										<a href="#" class="avatar">
											<img src="{{ $img }}" class="z-depth-4 circle" alt="users view avatar" height="64" width="64">
										</a>
										<div class="media-body" style="padding: 0 0px 15px 30px; width: 100%;">
											<div class="media-heading mb-0">
												<h5 class="mb-0" style="display: block; line-height: 23px; align-items: center; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 90%; font-weight: 300;">
													<i class="material-symbols-outlined mr-3 left" style="font-weight: 300;">person</i> {{ $paciente->nome }}
												</h5>
												<span class="users-view-username grey-text" style="display: flex; line-height: 24px; align-items: center;">
													<i class="material-symbols-outlined mr-3">credit_card</i> {{ format($paciente->cpf, 'cpf') }}
												</span>
											</div>
										</div>
									</div>
								</div>
								{{-- <div class="col s12 quick-action-btns display-flex justify-content-start align-items-center pt-2"> --}}
								{{-- <a href="#teste1" class="btn-small btn-teal z-depth-0 waves-effect" style="font-size: 22px; border-top-right-radius: 0;  border-bottom-right-radius: 0">
										<i class="material-symbols-outlined" style="font-weight: 300; font-size: inherit;">mail_outline</i>
									</a> --}}
								<div class="col s6 quick-action-btns display-flex justify-content-end align-items-center pt-2">
									<a href="#teste2" class="btn-small teal darken-1 z-depth-0 waves-effect" data-tooltip="Ver Prontuário" style="font-size: 22px;">
										<i class="material-symbols-outlined" style="font-weight: 300; font-size: inherit;">assignment_ind</i>
									</a>
								</div>
								<div class="col s6 quick-action-btns display-flex justify-content-start align-items-center pt-2">
									<a href="#teste3" class="btn-small teal darken-1 z-depth-0 waves-effect" data-tooltip="Editar Agendamento" style="font-size: 22px;">
										<i class="material-symbols-outlined" style="font-weight: 300; font-size: inherit;">edit_calendar</i>
									</a>
								</div>
								{{-- </div> --}}
							</div>
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
			</div>
		@endforeach

	</div>
@else
	<p>Não há agendamentos para {{ $regex ? 'esta data' : 'este mês' }}.</p>
@endif
