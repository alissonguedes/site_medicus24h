<x-clinica-layout>

	<x-slot:icon> edit_calendar </x-slot:icon>
	<x-slot:title> Agenda Médica </x-slot:title>

	<x-slot:main>

		<div class="card card-panel no-padding">

			<div class="card-content animated fadeIn">

				@if (!request('id_medico') || !request('id_clinica') || !request('id_especialidade') || !request('horario'))

					<div class="row">

						<div class="col s12 m6 l5">
							<div class="row">
								<div class="col s12">
									<p class="mb-3">
										Clique na data para ver as especialidades disponíveis.
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col s12">
									<div class="calendar_pk" data-url="{{ route('clinica.agendamentos.agenda.horarios') }}"></div>
								</div>
							</div>
						</div>

						<div class="col s12 m6 l7">

							{{-- <h5 for="f_medico" class="no-margin flex flex-center">
							<i class="material-symbols-outlined mr-1" style="font-size: 32px; line-height: 32px; ">filter_alt</i> Filtros
						</h5>
						<div class="input-field">
							<select name="medico" id="f_medico" class="autocomplete" data-url="{{ route('clinica.recursosmedicos.agenda.busca.medico_especialidade') }}" placeholder="Buscar por médico ou especialidade"></select>
						</div> --}}

							@if (request('year') && request('month') && request('day'))

								<ol>
									@foreach ($clinicas as $c => $especialidades)
										<li>
											Clínica: {{ $c }}
											<ol>
												@foreach ($especialidades as $especialidade => $dados)
													<li>
														{{ $especialidade }}
														<ol>
															@foreach ($dados as $v)
																<li>
																	{{-- {{ $v['medico'] }} - <x-nav-link href="{{ route('clinica.agendamento.marcar_consulta', [request('year'), request('month'), request('day'), $v['id_especialidade'], $v['id_medico']]) }}">Ver horários disponíveis</x-nav-link> --}}
																	{{ $v['medico'] }} - <a href="#modal-horarios-{{ $v['id_especialidade'] }}-{{ $v['id_medico'] }}" class="modal-trigger" data-trigger="modal-horarios">Ver horários disponíveis</a>
																</li>
																<div id="modal-horarios-{{ $v['id_especialidade'] }}-{{ $v['id_medico'] }}" class="modal modal-fixed-footer">
																	<div class="modal-content">
																		<h4>Agenda</h4>
																		<h5 class="mt-0">{{ $v['medico'] }} - {{ $v['especialidade'] }}</h5>
																		@php
																			$data = request('day') . '/' . request('month') . '/' . request('year');
																		@endphp
																		<p class="mt-3 mb-3">Horarios disponíveis para o dia {{ $data }}</p>
																		<p>
																			@foreach ($v['horarios'] as $h)
																				@php
																					$duracao = $v['duracao'];
																					$inicio = strtotime($h['inicio']);
																					$fim = strtotime($h['fim']);
																					$i = 0;
																					$turno = date('H', $inicio) < 12 ? 'Manhã' : 'Tarde';

																				@endphp

																				<table>
																					{{-- <caption>{{ $turno }}</caption> --}}
																					<thead>
																						<tr>
																							<th>Hora</th>
																							<th>Reserva</th>
																						</tr>
																					</thead>
																					<tbody>
																						@for ($hora = date('H', $inicio); $hora < date('H', $fim); $hora++)
																							@php
																								$turno = $hora < 12 ? 'Manhã' : 'Tarde';
																							@endphp
																							@php
																								$i = 0;
																							@endphp
																							@for ($minuto = 0; $minuto < 59 / $duracao; $minuto++)
																								@php
																									$h = $hora < 10 ? '0' . (int) $hora : $hora;
																									$m = $minuto * $duracao < 10 ? '0' . $minuto * $duracao : $minuto * $duracao;
																									$i++;
																								@endphp
																								<tr>
																									<td style="vertical-align: top;" width="10px">
																										{{ $h . ':' . $m }}
																									</td>
																									<td>
																										@php
																											$atendimento = DB::connection('medicus')
																											    ->table('tb_atendimento AS A')
																											    ->select(
																													'data',
																													'hora_agendada',
																													DB::raw('(SELECT nome FROM tb_paciente WHERE id = A.id_paciente) as paciente'),
																													DB::raw('(SELECT titulo FROM tb_empresa WHERE id = A.id_clinica) as clinica')
																												)
																											    ->where([
																											        'id_medico' => $v['id_medico'],
																											        'data' => date('Y-m-d', strtotime(str_replace('/', '-', $data))),
																											        'hora_agendada' => date('H:i:s', strtotime($h . ':' . $m)),
																											    ])
																											    ->get()
																											    ->first();
																										@endphp
																										@if (!isset($atendimento))
																											@php
																												$year = request('year');
																												$month = request('month');
																												$day = request('day');
																												$horario = strtotime(date('Y-m-d H:i:s', strtotime(request('year') . '-' . request('month') . '-' . request('day') . ' ' . $h . ':' . $m)));
																												$link = route('clinica.agendamentos.form', [$year, $month, $day, $horario, $v['id_medico'], $v['id_clinica'], $v['id_especialidade']]);
																											@endphp
																											<x-nav-link :href="$link">Reservar Horário</x-nav-link>
																										@else
																											{{ $atendimento->paciente }} <br> {{ $atendimento->clinica }} <br> {{ date('d/m/Y', strtotime($atendimento->data)) }} - {{ date('H:i', strtotime($atendimento->hora_agendada)) }}
																										@endif
																									</td>
																								</tr>
																							@endfor
																						@endfor
																					</tbody>
																				</table>
																				<br>
																			@endforeach
																		</p>
																	</div>
																	<div class="modal-footer">
																		<a href="#" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
																	</div>
																</div>
															@endforeach
														</ol>
													</li>
												@endforeach
											</ol>
										</li>
									@endforeach
								</ol>

								<script>
									$('.modal').modal();
								</script>

							@endif

						</div>

					</div>
				@else
				@endif

			</div>

			@if (request('id_medico') && request('id_clinica') && request('id_especialidade') && request('horario'))
				<div class="card-reveal no-padding" style="display: block; transform: translateY(-100%)">
					@include('clinica.agendamentos.form-agendamento')
				</div>
			@endif

			<style>
				.datepicker-controls button {
					display: flex;
					align-items: center;
					place-content: center;
					width: 32px;
					height: 32px;
					margin: 0 30px;
					border-radius: 24px;
				}

				#calendar_pk .datepicker-modal,
				#calendar_pk .modal-overlay {
					z-index: 1009 !important;
				}
			</style>

			@include('clinica.agendamentos.includes.scripts')

	</x-slot:main>

</x-clinica-layout>
