<script src="{{ asset('assets/node_modules/html2canvas/dist/html2canvas.js') }}"></script>
<script src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script>

<script>
	$(function() {

		$('[type="checkbox"]').bind('change', function(e) {

			var input = $('[name="' + $(this).attr('id') + '"]');

			input.attr('disabled', !$(this).prop('checked')).select();

			if (input[0].localName === 'select')
				input.formSelect();

		});

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
				$(this).select();
				// $(this).val('');
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
							<input type="text" name="horario[${dias_semana[dia]}][inicio][]" class="autocomplete timer browser-default" value="08:00" placeholder="hh:mm" autocomplete="off"> - <input type="text" name="horario[${dias_semana[dia]}][fim][]" class="autocomplete timer browser-default" value="17:00" placeholder="hh:mm" autocomplete="off">
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

		$('select[name="medico"]').bind('change', function() {

			var self = $(this);
			var value = self.val();
			var select_clinica = $('select[name="clinica"]');

			$.ajax({
				url: select_clinica.data('url'),
				data: {
					'medico': value,
				},
				method: 'get',
				success: (response) => {

					var options = [];

					select_clinica
						// .attr('disabled', true)
						.find('option:not([value=""])').remove();

					select_clinica.trigger('change')
					// .formSelect();

					if (response) {

						for (var i of response) {

							options.push($('<option/>', {
								'value': i.id,
								'text': i.text
							}));

						}

						select_clinica.append(options);
						select_clinica.attr('disabled', false).val('Agenda referente à clinica').formSelect();

					}

				}
			})

		})

	});
</script>

<style>
	.autocomplete-content.dropdown-content {
		max-height: 220px;
		top: 38px !important;
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
		align-items: start;
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

	.day-range .horario {
		width: 100%;
		flex: 1 100%;
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

	.time-range .error {
		top: 10px;
	}

	.time-range.disabled {
		color: var(--grey);
		/* align-items: center; */
		/* display: flex; */
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
