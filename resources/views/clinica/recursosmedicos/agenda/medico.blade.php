<x-clinica-layout>

	<x-slot:icon data-href="{{ route('clinica.recursosmedicos.agenda.index') }}">arrow_back</x-slot:icon>
	<x-slot:title>Agenda Médica</x-slot:title>

	<x-slot:main>

		<div class="card card-panel no-padding no-margin">

			<form action="{{ route('clinica.recursosmedicos.agenda.medico', request('id_medico')) }}" method="post" id="main-form">

				<div class="card-content" style=" height: calc(100% - 60px); overflow: auto; position: absolute; left: 0; right: 0; bottom: 0; top: 0;">

					@csrf
					<input type="hidden" name="categoria" value="profissional">

					@if (request('id_medico'))
						<input type="hidden" name="_method" value="put">
						<input type="hidden" name="medico" value="{{ $medico->id }}">
					@endif

					<div class="row">
						<div class="col s12">
							<h5>Horários de atendimento: {{ $medico->nome }}</h5>
							<input type="hidden" name="titulo" value="Agenda médica: {{ $medico->nome }}">
						</div>
					</div>

					<div class="row">
						<div class="col s12 mb-2">
							<p>Aqui, você pode informar os dias e horários que o médico estará disponível para atendimento na clínica.</p>
						</div>
					</div>

					<div class="row">
						<div class="col s12 m4 l4">
							<div class="input-field @error('clinica') error @enderror">
								<div class="row">
									<div class="col s12">
										<label for="clinica" class="active strong black-text">Agenda <i class="material-symbols-outlined grey-text pointer" data-position="right" data-tooltip="O sistema consulta todas as agendas disponíveis<br>para este médico, para evitar conflitos de horários;<br>antes do agendamento de um compromisso, <br>todas as agenda de todas as clínicas serão analisadas<br>para validar quais horários estão livres." style="font-size: 16px; position: relative; top: 3px; font-weight: bold; color: inherit !important;">help</i></label>
										<br>
										<small class="grey-text text-darken-4">Verificar a disponibilidade em todas as clínicas onde o médico estará disponível para atendimentos.</small>
										<br>
										<small class="grey-text">Esta é a clínica onde o médico estará disponível para esta agenda.</small>
									</div>
								</div>
								<script>
									function redirect_to_clinica(value) {
										var url = "{{ route('clinica.recursosmedicos.agenda.medico', [request('id_medico')]) }}"
										location.href = url + '/' + value;
									}
								</script>
								<div class="row">
									<div class="col s12">
										<select name="clinica" id="clinica" onChange="redirect_to_clinica(this.value);">
											<option value="" disabled selected>Informe a clínica</option>
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
													<option value="{{ $e->id }}" @selected(old('clinca') ?? request('id_clinica') == $e->id)>{{ $e->razao_social }}</option>
												@endforeach
											@endif
										</select>
									</div>
								</div>
								<div class="row">
									@error('clinica')
										<div class="col s12 error">{{ $message }}</div>
									@enderror
								</div>
							</div>
						</div>
					</div>

					@if (request('id_clinica'))

						@php
							$agenda_model = new App\Models\Clinica\AgendaModel();
							$agenda_dados = $agenda_model->select('id', 'id_medico', 'id_clinica', 'titulo', 'observacao', 'duracao', 'tempo_min_agendamento', 'tempo_max_agendamento', 'intervalo', 'max_agendamento', 'repetir', 'status')->from('tb_medico_agenda')->where('id_medico', request('id_medico'))->where('id_clinica', request('id_clinica'))->get()->first();
						@endphp
						<div class="row">
							<div class="col s12 m4 l4">
								<div class="input-field">
									<div class="row">
										<div class="col s12">
											<label for="duracao_horarios" class="active strong black-text">Duração dos horários</label>
											<br>
											<small class="grey-text">Qual será a duração de cada horário?</small>
										</div>
									</div>
									<div class="row">
										<div class="col s12">
											<select name="duracao" id="duracao">
												<option value="15" @selected(old('duracao') ?? $agenda_dados->duracao == 15)>15 minutos</option>
												<option value="30" @selected(old('duracao') ?? $agenda_dados->duracao == 30)>30 minutos</option>
												<option value="45" @selected(old('duracao') ?? $agenda_dados->duracao == 45)>45 minutos</option>
												<option value="60" @selected(old('duracao') ?? $agenda_dados->duracao == 60)>1 hora</option>
												<option value="75" @selected(old('duracao') ?? $agenda_dados->duracao == 75)>1,5 hora</option>
												<option value="120" @selected(old('duracao') ?? $agenda_dados->duracao == 120)>2 horas</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col s12 m4 l4">
								<div class="input-field">
									<div class="row">
										<div class="col s12">
											<label for="disponibilidade" class="active strong black-text">Disponibilidade</label>
											<br>
											<small class="grey-text">Defina os horários em que o médico estará disponível.</small>
										</div>
									</div>
									<div class="row">
										<div class="col s12">
											<select name="repetir" id="repetir" class="">
												<option value="0"@selected(old('repetir') ?? $agenda_dados->repetir == 0)>Não se repete</option>
												<option value="1"@selected(old('repetir') ?? $agenda_dados->repetir == 1)>Repetir Diariamente</option>
												<option value="7" @selected(old('repetir') ?? $agenda_dados->repetir == 7)>Repetir semanalmente</option>
												<option value="30"@selected(old('repetir') ?? $agenda_dados->repetir == 30)>Repetir mensalmente</option>
												<option value="365"@selected(old('repetir') ?? $agenda_dados->repetir == 365)>Repetir anualmente</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col s12">
								<div class="input-field @error('horarios') error @enderror">
									<div class="row">
										@error('horarios')
											<div class="col s12 error">{{ $message }}</div>
										@enderror
									</div>
									<div class="row">
										<div class="col s12">
											@php
												$dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
												$horarios_agenda = [];
											@endphp

											@foreach ($dias_semana as $key => $day)
												@php
													$horarios = $agenda_model
													    ->from('tb_medico_agenda_horario')
													    ->where('id_agenda', $agenda_dados->id)
													    ->where('dia', $key)
													    ->get();
												@endphp
												<div class="row">
													<div class="col s12">
														<div class="day-range">
															<div class="dia-semana">
																<label class="strong black-text">{{ $day }}</label>
															</div>
															<div class="horario" data-day="{{ $key }}">
																@if (isset($horarios) && $horarios->count() > 0)
																	@foreach ($horarios as $hora)
																		<div class="time-range">
																			<div class="input-field m-0 mb-1">
																				<input type="text" name="horario[{{ replace($day) }}][inicio][]" class="autocomplete timer browser-default" value="{{ date('H:i', strtotime($hora->inicio)) }}" placeholder="hh:mm" autocomplete="off"> - <input type="text" name="horario[{{ replace($day) }}][fim][]" class="autocomplete timer browser-default" value="{{ date('H:i', strtotime($hora->fim)) }}" placeholder="hh:mm" autocomplete="off">
																				<div class="acao">
																					<button type="button" class="btn btn-small btn-flat btn-floating transparent" data-trigger="delete_time">
																						<i class="material-symbols-outlined">block</i>
																					</button>
																					<button type="button" class="btn btn-small btn-flat btn-floating transparent" data-trigger="add_time">
																						<i class="material-symbols-outlined">add</i>
																					</button>
																				</div>
																			</div>
																		</div>
																	@endforeach
																	<div class="time-range disabled grey-text text-lighten-1 {{ replace($day) != 'domingo' && replace($day) != 'sabado' ? 'hide' : null }}">
																		<div class="input-field m-0 mb-1">
																			<div class="label">Indisponível</div>
																		</div>
																		<div class="acao">
																			<button type="button" class="btn btn-small btn-flat btn-floating transparent" data-trigger="delete_time" disabled>
																				<i class="material-symbols-outlined">block</i>
																			</button>
																			<button type="button" class="btn btn-small btn-flat btn-floating transparent" data-trigger="add_time">
																				<i class="material-symbols-outlined">add</i>
																			</button>
																		</div>
																	</div>
																@else
																	<div class="time-range disabled grey-text text-lighten-1">
																		<div class="input-field m-0 mb-1">
																			<div class="label">Indisponível</div>
																		</div>
																		<div class="acao">
																			<button type="button" class="btn btn-small btn-flat btn-floating transparent" data-trigger="delete_time" disabled>
																				<i class="material-symbols-outlined">block</i>
																			</button>
																			<button type="button" class="btn btn-small btn-flat btn-floating transparent" data-trigger="add_time">
																				<i class="material-symbols-outlined">add</i>
																			</button>
																		</div>
																	</div>
																@endif
															</div>
														</div>
													</div>
												</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col s12 m4 l4">
								<div class="input-field">
									<div class="row">
										<div class="col s12">
											<label for="disponibilidade" class="active strong black-text">Janela de programação</label>
											<br>
											<small class="grey-text">Período permitido para agendamento entre os horários.</small>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col s12">
											<small class="strong">O tempo máximo de antecedência para reservar um horário</small>
										</div>
										<div class="col s12">
											<div class="flex flex-center flex-start">
												<label>
													<input type="checkbox" name="" id="tempo_max_agendamento" class="filled-in">
													<span></span>
												</label>
												<input type="number" name="tempo_max_agendamento" class="center-align col s2 ml-0 mr-3" value="{{ old('tempo_max_agendamento', $agenda_dados->tempo_max_agendamento) ?? 30 }}" style="padding-left: 10px;" disabled min="1" step="1">
												<span>dias</span>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col s12">
											<small class="strong">O tempo mínimo de antecedência para reservar um horário</small>
										</div>
										<div class="col s12">
											<div class="flex flex-center flex-start">
												<label>
													<input type="checkbox" name="" id="tempo_min_agendamento" class="filled-in">
													<span></span>
												</label>
												<input type="number" name="tempo_min_agendamento" class="center-align col s2 ml-0 mr-3" value="{{ old('tempo_min_agendamento', $agenda_dados->tempo_min_agendamento) ?? 1 }}" style="padding-left: 10px;" disabled min="0" max="24" step="1">
												<span>horas</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col s12 m4 l4">
								<div class="input-field">
									<div class="row">
										<div class="col s12">
											<label for="intervalo" class="active strong black-text">Configurações dos Agendamentos</label>
											<br>
											<small class="grey-text">Gerenciar os horários marcados</small>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col s12">
											<small class="strong">Intervalo</small>
											<br>
											<small class="grey-text">Intervalo entre os horários disponíveis</small>
										</div>
										<div class="col s12">
											<div class="flex flex-center flex-start">
												<label>
													<input type="checkbox" name="" id="intervalo" class="filled-in">
													<span></span>
												</label>
												<select name="intervalo" disabled>
													{{-- <option value="0" @selected(old('intervalo', $agenda_dados->intervalo == 0))>Sem intervalo</option> --}}
													<option value="15" @selected(old('intervalo', $agenda_dados->intervalo == 15))>15 minutos</option>
													<option value="30" @selected(old('intervalo', $agenda_dados->intervalo == 30))>30 minutos</option>
													<option value="45" @selected(old('intervalo', $agenda_dados->intervalo == 45))>45 minutos</option>
													<option value="60" @selected(old('intervalo', $agenda_dados->intervalo == 60))>1 hora</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col s12">
											<small class="strong">Número máximo de agendamentos por dia</small>
											<br>
											<small class="grey-text">Limite o número de horários agendados para aceitar em um único dia</small>
										</div>
										<div class="col s12">
											<div class="flex flex-center flex-start">
												<label>
													<input type="checkbox" name="" id="max_agendamento" class="filled-in">
													<span></span>
												</label>
												<input type="number" name="max_agendamento" class="center-align col s2 ml-0 mr-3" value="{{ old('max_agendamento', $agenda_dados->max_agendamento) ?? 10 }}" style="padding-left: 10px;" disabled min="1" max="30" step="1">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						@include('clinica.recursosmedicos.agenda.includes.scripts')

					@endif

				</div>

				<div class="card-action">
					<div class="row">
						<div class="col s12 right-align">
							<button type="reset" class="btn btn-large waves-effect">
								<i class="material-symbols-outlined hide-on-small-only left">cancel</i>
								<span class="">Cancelar</span>
							</button>
							<button type="submit" class="btn btn-large waves-effect">
								<i class="material-symbols-outlined hide-on-small-only left">save</i>
								<span class="">Salvar</span>
							</button>
						</div>
					</div>
				</div>

			</form>

		</div>

	</x-slot:main>

	{{-- @include('clinica.recursosmedicos.agenda.includes.form') --}}

</x-clinica-layout>
