@php
	$id = null;
@endphp

<x-form action="{{ route('clinica.recursosmedicos.agenda.index') }}" id="main-form" style="{{ $errors->any() || request()->routeIs('clinica.recursosmedicos.agenda.disponibilidade') ? 'display: block;' : 'display: none;' }}">

	@csrf
	<input type="hidden" name="categoria" value="agenda">

	@if (request('id'))
		<input type="hidden" name="_method" value="put">
		<input type="hidden" name="id" value="{{ $id }}">
	@endif

	<x-slot:content>

		<div class="row">
			<div class="col s12">
				<p>Aqui, você pode informar os dias e horários que cada médico estará disponível para atendimento na clínica.</p>
			</div>
		</div>

		<hr class="">

		<div class="row">
			<div class="col s12">
				<div class="input-field @error('medico') error @enderror">
					<label for="medico" class="active strong black-text">Médico</label>
					@if (request('id_medico'))
						@php
							$medico = DB::connection('medicus')->table('tb_funcionario')->select('nome')->where('id', request('id_medico'))->first();
						@endphp
						<div class="input-label disabled">{{ $medico->nome }}</div>
						<input type="hidden" name="medico" value="{{ request('id_medico') }}">
					@else
						<select name="medico" id="medico" class="autocomplete" data-url="{{ route('clinica.medicos.autocomplete') }}" placeholder="Pesquise pelo Nome, CPF, Matrícula ou RG"></select>
					@endif
					@error('medico')
						<div class="error">{{ $message }}</div>
					@enderror
				</div>
			</div>
		</div>

		{{-- <div class="row">
		<div class="col s12">
			<div class="input-field">
				<div class="row">
					<div class="col s12">
						<label for="duracao_horarios" class="active strong black-text">Duração dos horários</label>
						<br>
						<small class="grey-text">Qual será a duração de cada horário?</small>
					</div>
				</div>
				<div class="row">
					<div class="col s12 m5 l5 mt-1 mb-2">
						<select name="duracao_horarios" id="duracao_horarios" class="">
							<option value="15" selected>15 minutos</option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div> --}}

		<div class="row">
			<div class="col s12">
				<div class="input-field">

					{{-- <div class="row">
					<div class="col s12">
						<label for="duracao_horarios" class="active strong black-text">Disponibilidade</label>
						<br>
						<small class="grey-text">Defina os horários em que você está disponível.</small>
					</div>
				</div> --}}
					{{--
				<div class="row">
					<div class="col s12 m5 l5 mt-1 mb-2">
						<select name="duracao_horarios" id="duracao_horarios" class="">
							<option value="" selected>Repetir semanalmente</option>
						</select>
					</div>
				</div> --}}

					<style>
						.autocomplete-content.dropdown-content {
							max-height: 220px;
						}

						.day-range,
						.acao {
							display: flex;
							align-items: start;
							margin-right: 25px;
						}

						.time-range .input-field {
							display: flex;
							align-items: center;
						}

						.time-range {
							/* margin-bottom: 15px; */
							display: flex;
							align-items: center;
						}

						.day-range .dia-semana {
							width: 250px;
							display: block;
							margin-right: 15px;
							margin-top: 6px;
							-webkit-box-flex: 0;
							-webkit-flex: none;
							flex: none;
							width: 84px;
						}

						.day-range .acao {
							color: rgb(95, 99, 104);
						}

						.day-range .acao button {
							margin: 0 5px;
							color: inherit;
						}

						.day-range .acao button i {
							color: inherit;
							font-size: 24px;
							font-weight: 300;
						}

						.time-range input {
							width: 100px;
							padding: 10px;
							border: none;
							outline: none;
							background-color: var(--grey-accent-2);
							text-align: center;
							margin: 0 15px;
						}

						.time-range.disabled {
							color: var(--grey);
							align-items: center;
							display: flex;
							margin-top: 2px;
						}

						.time-range.disabled.hide {
							display: none;
						}

						.time-range .input-field .label {
							margin: 5px 15px;
							width: 234px;
							text-align: left;
						}
					</style>

					@php
						$dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
					@endphp

					@foreach ($dias_semana as $key => $day)
						<div class="row">
							<div class="col s12 m5 l5">
								<div class="day-range">
									<div class="dia-semana">
										<label class="strong black-text">{{ $day }}</label>
									</div>
									<div class="horario" data-day="{{ $key }}">
										@if (replace($day) != 'domingo' && replace($day) != 'sabado')
											<div class="time-range">
												<div class="input-field m-0 mb-1">
													<input type="text" name="horario[{{ replace($day) }}][inicio][]" class="autocomplete timer browser-default" value="08:00" placeholder="hh:mm"> - <input type="text" name="horario[{{ replace($day) }}][fim][]" class="autocomplete timer browser-default" value="17:00" placeholder="hh:mm">
													<div class="acao">
														<button type="button" class="btn btn-small btn-flat btn-floating transparent" data-trigger="delete_time">
															<i class="material-symbols-outlined">block</i>
														</button>
														<button type="button" class="btn btn-small btn-flat btn-floating transparent" data-trigger="add_time">
															<i class="material-symbols-outlined">add</i>
														</button>
														{{-- <button type="button" class="btn btn-small btn-flat btn-floating transparent" data-trigger="copy_time">
													<i class="material-symbols-outlined">content_copy</i>
												</button> --}}
													</div>
												</div>
												{{-- <div class="error">Os períodos não podem se sobrepor</div> --}}
											</div>
										@endif
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
									</div>
								</div>
							</div>
						</div>
					@endforeach

				</div>
			</div>
		</div>
	</x-slot:content>

	<x-slot:footer>
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
	</x-slot:footer>

	@include('clinica.homecare.pacientes.includes.scripts')

	<script>
		$(function() {

			function show_times_interval(HORA_INICIAL = 0, MINUTO_INICIAL = 0) {
				var razao = 30;
				for (var h = HORA_INICIAL; h <= 23; h++) {
					var hora = h < 10 ? '0' + h : h;
					for (var i = MINUTO_INICIAL; i <= 59 / razao; i++) {
						var m = i * razao;
						var minuto = m < 10 ? '0' + m : m;
						Object.assign(times, {
							[hora + ':' + minuto]: null
						});
					}
				}
			}

			var times = {};

			show_times_interval();
			buttons_time_range_action();

			var atual_value = null;
			var selected_value = null;

			function buttons_time_range_action() {

				var dias_semana = ['domingo', 'segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado'];

				var input_timer = $('input.autocomplete.timer');
				var autocomplete = input_timer.autocomplete({
					data: times,
					minLength: 0,
					onAutocomplete: (value) => {

						agenda = [];
						selected_value = value;

						buttons_time_range_action();
						show_times_interval();

					}

				});

				input_timer.bind('focus', function() {
					atual_value = $(this).val();
					$(this).val('');
				}).bind('blur', function() {
					if ($(this).val() == '' || selected_value == atual_value) {
						$(this).val(atual_value);
					}
				});

				$('.day-range').each(function() {

					var periodo = {};
					var horario = [];

					var hora_inicial_anterior = null;
					var hora_final_anterior = null;

					$(this).find('.horario').find('.time-range').each(function(index) {

						$(this).find('.error').remove();

						var dia = $(this).parents('.horario').data('day');
						var range = $(this).find('input');
						var inicio = $(range[0]).val();
						var fim = $(range[1]).val();

						// var dia = $(this).find('.dia-semana').find('input[name="dia"]').val();

						console.log(dias_semana, dia);
						var div_time_range = `
							<div class="time-range">
								<div class="input-field m-0 mb-1">
									<input type="text" name="horario[${dias_semana[dia]}][inicio][]" class="autocomplete timer browser-default" value="08:00" placeholder="hh:mm"> - <input type="text" name="horario[${dias_semana[dia]}][fim][]" class="autocomplete timer browser-default" value="17:00" placeholder="hh:mm">
									<div class="acao">
										<button type="button" class="btn btn-small btn-flat btn-floating transparent" data-trigger="delete_time">
											<i class="material-symbols-outlined">block</i>
										</button>
										<button type="button" class="btn btn-small btn-flat btn-floating transparent hide" data-trigger="add_time">
											<i class="material-symbols-outlined">add</i>
										</button>
										{{-- <button type="button" class="btn btn-small btn-flat btn-floating transparent hide" data-trigger="copy_time">
											<i class="material-symbols-outlined">content_copy</i>
										</button> --}}
									</div>
								</div>
							</div>`

						if (inicio && fim) {

							if (inicio > fim) {

								$(this).append('<div class="error ml-4 mt-0">O horário de início precisa ser anterior ao horário de término</div>');

							} else if (fim > inicio && (inicio < hora_inicial_anterior || inicio < hora_final_anterior)) {

								$(this).append('<div class="error ml-4 mt-0">Os períodos não podem se  sobrepor</div>');

								console.log('Os horários não podem se  sobrepor: INDEX (' + index + '): ' + inicio + ' -> ' + hora_final_anterior);

							}

							hora_inicial_anterior = inicio;
							hora_final_anterior = fim;

						}

						$(this).find('.acao button').unbind().bind('click', function() {

							var time_index = $(this).parents('.time-range:not(.disabled)');
							var time_length = $(this).parents('.horario').find('.time-range:not(.disabled)').length;
							var acao = $(this).data('trigger');
							var new_range = $(this).parents('.horario').find('.time-range:not(.disabled)');

							switch (acao) {

								case 'delete_time':

									if (time_length === 1) {
										$(this).parents('.horario').find('.time-range.disabled').removeClass('hide');
									}

									if (time_index.index() <= 1) {
										$(this).parents('.time-range').next().find('.acao').find('button').each(function() {
											if ($(this).hasClass('hide')) {
												$(this).removeClass('hide');
											}
										});
									}

									if (time_length > 0) {

										$(this).closest('.time-range:not(.disabled)').remove();

									}

									break;

								case 'add_time':

									$(this).parents('.horario').append(div_time_range);

									if (time_length > -1) {

										$(this).parents('.horario').find('.time-range.disabled').addClass('hide');

										if (time_length === 0) {
											$(this).parents('.time-range').next().find('.acao').find('button').each(function() {
												if ($(this).hasClass('hide')) {
													$(this).removeClass('hide');
												}
											});
										}

									}

									buttons_time_range_action();

									break;

							}

						});

					});

				});

			}

		});
	</script>
</x-form>

<x-form id="form-agendamento" style="{{ $errors->any() || request()->routeIs('clinica.recursosmedicos.agenda.medico.agendamento') ? 'display: block;' : 'display: none;' }}">

	{{-- @csrf --}}

	<x-slot:footer>
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
	</x-slot:footer>

</x-form>
