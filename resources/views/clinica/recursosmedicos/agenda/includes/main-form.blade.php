@php
	$id = null;
@endphp

<x-form action="{{ route('clinica.recursosmedicos.agenda.index') }}">

	@csrf
	<input type="hidden" name="categoria" value="agenda">

	@if (request('id'))
		<input type="hidden" name="_method" value="put">
		<input type="hidden" name="id" value="{{ $id }}">
	@endif

	{{-- <x-slot:tabs>
		<ul class="tabs tabs-fixed-width">
			<li class="tab"><a href="#dados-pessoais" class="active">Dados Pessoais</a></li>
			<li class="tab"><a href="#contato">Contato</a></li>
			<li class="tab"><a href="#endereco">Endereço</a></li>
			<li class="tab"><a href="#convenio">Convênio</a></li>
			<li class="tab"><a href="#observacoes">Observações</a></li>
			<li class="tab"><a href="#outras_informacoes">Outras informações</a></li>
		</ul>
	</x-slot:tabs> --}}

	<div class="row">
		<div class="col s12">
			<p>Aqui, você pode informar os dias e horários que está disponível para atendimento na clínica.</p>
		</div>
	</div>

	<hr class="">

	<div class="row">
		{{-- <div class="col s12">
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
		</div> --}}
	</div>

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
						margin-bottom: 15px;
					}

					.day-range .dia-semana {
						width: 250px;
						display: block;
						margin-right: 15px;
						margin-top: 10px;
						-webkit-box-flex: 0;
						-webkit-flex: none;
						flex: none;
						width: 84px;
					}

					.time-disabled {
						display: none;
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
				</style>

				@php
					$dias_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
				@endphp

				@foreach ($dias_semana as $key => $value)
					<div class="row">
						<div class="col s12 m5 l5">
							<div class="day-range">
								<div class="dia-semana">
									<label class="strong black-text">{{ $value }}</label>
									<input type="text" name="dia" value="{{ $key }}">
								</div>
								<div class="horario">
									<div class="time-range">
										<div class="input-field m-0 mb-1">
											<input type="text" name="hora_inicio[{{ replace($value) }}][]" class="autocomplete timer browser-default" placeholder="hh:mm"> - <input type="text" name="hora_fim[{{ replace($value) }}][]" class="autocomplete timer browser-default" placeholder="hh:mm">
											<div class="acao">
												<button type="button" class="btn btn-small btn-flat btn-floating transparent">
													<i class="material-symbols-outlined">block</i>
												</button>
												<button type="button" class="btn btn-small btn-flat btn-floating transparent">
													<i class="material-symbols-outlined">add</i>
												</button>
												<button type="button" class="btn btn-small btn-flat btn-floating transparent">
													<i class="material-symbols-outlined">content_copy</i>
												</button>
											</div>
										</div>
									</div>
									<div class="time-range">
										<div class="input-field m-0 mb-1">
											<input type="text" name="hora_inicio[{{ replace($value) }}][]" class="autocomplete timer browser-default" placeholder="hh:mm"> - <input type="text" name="hora_fim[{{ replace($value) }}][]" class="autocomplete timer browser-default" placeholder="hh:mm">
											<div class="acao">
												<button type="button" class="btn btn-small btn-flat btn-floating transparent">
													<i class="material-symbols-outlined">block</i>
												</button>
											</div>
										</div>
									</div>
									<div class="time-range">
										<div class="input-field m-0 mb-1">
											<input type="text" name="hora_inicio[{{ replace($value) }}][]" class="autocomplete timer browser-default" placeholder="hh:mm"> - <input type="text" name="hora_fim[{{ replace($value) }}][]" class="autocomplete timer browser-default" placeholder="hh:mm">
											<div class="acao">
												<button type="button" class="btn btn-small btn-flat btn-floating transparent">
													<i class="material-symbols-outlined">block</i>
												</button>
											</div>
										</div>
									</div>
									<div class="time-disabled">
										Indisponível
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach

			</div>
		</div>
	</div>

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

	<script>
		$(function() {

			var times = {};

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

			show_times_interval();

			var dias_semana = ['domingo', 'segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado'];
			var atual_value = null;
			var selected_value = null;

			var input_timer = $('input.autocomplete.timer');
			var autocomplete = input_timer.autocomplete({
				data: times,
				minLength: 0,
				onAutocomplete: (value) => {

					agenda = [];
					selected_value = value;

					$('.day-range').each(function() {

						var dia = $(this).find('.dia-semana').find('input[name="dia"]').val();

						var periodo = {};
						var horarios = [];

						$(this).find('.horario').find('.time-range').each(function(index) {

							$(this).find('.error').remove();

							var range = $(this).find('input');
							var inicio = $(range[0]).val();
							var fim = $(range[1]).val();

							if (inicio && fim) {

								if (inicio >= fim) {

									$(this).append('<div class="error ml-4 mt-0">O horário de início precisa ser anterior ao horário de término</div>');

								} else {

									horarios.push({
										'inicio': inicio,
										'fim': fim
									})

									Object.assign(periodo, {
										[dias_semana[dia]]: horarios
									});

								}

								agenda.push(periodo);

							}

						});

					});

					if (agenda.length) {

						for (var i in agenda) {

							for (var j in agenda[i]) {

								var horarios = agenda[i][j];
								var dia = j;

								hora_inicial = null;
								hora_final = null;

								for (var h in horarios) {

									var inicio = horarios[h]['inicio'];
									var fim = horarios[h]['fim'];

									if (hora_inicial || hora_final) {

										if (hora_final >= inicio) {
											console.log(hora_final, inicio, 'Os horário não podem se sobrepor');
										}

									}

									hora_inicial = inicio;
									hora_final = fim;

								}

								console.log(hora_inicial, hora_final);

							}

						}

					}

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

		});
	</script>
</x-form>
