'use strict';

var loading = `<div class="progress">
					<div class="indeterminate gradient-45deg-blue-indigo accent-2"></div>
				</div>`;

/**
 * Botão para adicionar novo plano à tabela de relação de planos de saúde vinculados ao perfil do paciente
 * Form: Pacientes
 * Aba: Planos
 */
$('[data-trigger="add_plano"],[data-trigger="edit_plano"]').unbind().bind('click', function () {

	var target = '#form_plano_saude';
	var modal = $(target);
	var url = $(this).data('url');
	// var id = $(this).attr('id') && typeof $(this).attr('id') === 'numeric' ? $(this).attr('id') : null;
	var action = $(this).data('trigger');
	var data = {
		paciente: $('input[type=hidden][name="id"]').val()
	}

	if (action == 'edit_plano') {
		var id = $(this).parent('tr').attr('id');
		var plano = $(this).parent('td').find('[name="outros_convenios[]"]').val();
		var data = {
			id: id,
			id_convenio: plano.id_convenio,
			id_tipo: plano.id_tipo,
			id_acomodacao: plano.id_acomodacao,
			matricula: plano.matricula,
			validade_ano: plano.validade_ano,
			validade_mes: plano.validade_mes,
		}
	}

	// progress('in', 'bar');

	var m = modal.modal({
		dismissible: true,
		onOpenStart: () => {

			modal.html(loading);

			$.ajax({
				url: url,
				datatype: 'html',
				data: data,
				success: (response) => {

					modal.html($(response).html());
					console.log();

					var select = $('select[name="id_tipo_plano"]');
					var surl = select.data('url');

					$('select[name="id_plano"]').bind('change', function () {

						var url = $(this).data('url');
						var id = $(this).val();

						var options = '<option value="" disabled selected>Informe o tipo de convênio</option>';
						select.find('option').remove();
						select.val('').html(options);
						select.attr('disabled', true);

						$.ajax({
							'method': 'get',
							'url': url,
							'data': {
								'id_plano': id
							},
							'datatype': 'json',
							'success': (response) => {

								select.parents('.input-field').find('select').each(function () {
									$(this).attr('disabled', false) // .Materialize('select');
										.select2({
											minimumInputLength: 0,
											minimuResultsForSearch: 1,
											dropdownAutoWidth: true,
											dropdownPosition: 'below',
											// width: 100%,
											language: {
												inputTooShort: function () {
													return 'Você deve inserir 3 caracteres'
												},
												noResults: function () {
													return 'Nenhum resultado encontrado';
												},
												searching: function () {
													// return 'Buscando...';
												},
												errorLoading: function () {
													return 'Houve um erro ao carregar os dados';
												}
											},
											ajax: {
												url: surl,
												dataType: 'json',
												delay: 300,
												beforeSend: () => {
													progress('in', 'bar');
													console.log('teste')
												},
												success: () => {
													progress('out');
													console.log('tete')
												},
												data: (data) => {

													search['id_plano'] = id;
													search['query'] = data.term || null;
													search['page'] = data.page || 1;

													// progress('out');

													return search;

												},
												processResults: function (data) {

													return {
														results: data.items,
													}

												}
											},
										});
								})

							}

						});

					});

					// new Core();

				}

			});

		},

		onOpenEnd: () => {

		},

		onCloseStart: () => {
			modal.find('form').find('button[type="reset"]').click();
		}

	});

	// m = M.Modal.getInstance(m);
	modal.modal('open');
	// m.open();

});


/**
 * Escreve o nome do paciente no cartão Médicus24h ao digitar no campo nome
 * Form: Pacientes
 * Aba: Convênio
 */
$('input[name="nome"]').bind('keyup', function () {
	$('#cartao_convenio')
		.find('p#nome_paciente')
		.text($(this).val());
});

$('input[name="cpf"]').bind('keyup', function () {
	$('#cartao_convenio').find('p#cpf_paciente').text($(this).val());
});

$('input[name="cns"]').bind('keyup', function () {
	$('#cartao_convenio').find('p#cns_paciente').text($(this).val());
});

$('input[name="data_nascimento"]').bind('keyup change', function () {
	$('#cartao_convenio').find('p#data_nascimento_paciente').text($(this).val());
});

$('select[name="validade_mes"]#mes,select[name="validade_ano"]#ano').bind('change', function () {
	var mes = $('select[name="validade_mes"]#mes').val();
	var ano = $('select[name="validade_ano"]#ano').val();
	var validade = null;
	if (mes && ano) {
		validade = mes + '/' + ano[2] + ano[3];
	}
	$('#cartao_convenio').find('p#validade_convenio_paciente').text(validade);
	$('input[type="hidden"][name="validade"]').val(ano + '-' + mes);
});

$('select[name="id_tipo_convenio"]').bind('change', function () {
	$('#id_tipo_convenio').text($(this).find('option:selected').text());
});

$('select[name="id_acomodacao"]').bind('change', function () {
	$('#id_acomodacao').text($(this).find('option:selected').text());
});

$('#print_card').bind('click', function () {

	$('#cartao_convenio').css({
		'height': '12cm'
	});

	$('#cartao_convenio').find('.frente,.verso').removeClass('hide animated flipInX flipOutX z-depth-3').css({
		'display': 'block',
		'opacity': '1'
	});

	$('#cartao_convenio').find('.verso').css({
		'top': '5.5cm',
	});

	html2canvas(document.querySelector("#cartao_convenio"), {
		// allowTaint: true,
		// foreignObjectRendering: true
	}).then(canvas => {
		var image = canvas.toDataURL('image/png');
		$('#modal_cartao_convenio').find('.modal-content').html('<img src="' + image + '" alt="">');
	});

	var title = $('title').text();

	var modal = $('#modal_cartao_convenio').modal({
		onOpenEnd: () => {
			var document_title = title + '-' + $('input[name="nome"]').val().replace(/\s/g, '-') + '_' + moment().format('YYYY-MM-DD_hh-mm-ss');
			$('title').text(document_title);
		},
		onCloseStart: () => {
			$('title').text(title);
			$('#cartao_convenio').css({
				'height': '5cm'
			});
			$('#cartao_convenio').find('.frente,.verso').addClass('z-depth-3');
			$('#cartao_convenio').find('.verso').addClass('hide').css({
				'top': '0',
			})
		}
	});

	modal.modal('open');

});

$('[data-trigger="print"]').unbind().bind('click', function () {
	$('#modal_cartao_convenio').find('.modal-content').print();
});

$('.credit_card').bind('click', function () {
	if ($(this).find('.frente').is(':visible')) {
		$(this).find('.frente').removeClass('flipInY slow show').addClass('animated slow flipOutY').addClass('hide');
		$(this).find('.verso').removeClass('flipOutY slow hide').addClass('animated slow flipInY').addClass('show');
	} else {
		$(this).find('.frente').removeClass('flipOutY slower hide').addClass('animated slow flipInY').addClass('show');
		$(this).find('.verso').removeClass('flipInY slow show').addClass('animated slow flipOutY').addClass('hide');
	}
});

/**
 * Ativa/Inativa os Inputs do convênio médicus24h ou convencional
 */
// $('input[name="associado"]')

/**
 * Ativa/Inativa checkbox e caixa de texto
 * Form: Pacientes
 * Aba: Outras Informações.
 */
$('input[name="obito"]').unbind().bind('change', function () {

	var status = $('input[name="status"]');
	var datahora_obito = $('input[name="data_obito"], input[name="hora_obito"]');
	var value = $(this).val();

	if ($(this).prop('checked')) {
		status.prop('checked', false);
		status.attr('disabled', true);
		datahora_obito.attr('disabled', false).parent().find('label').css('color', 'var(--blue-accent-1)');
	} else {
		status.attr('disabled', false);
		datahora_obito.val('').attr('disabled', true).parent().find('label').css('color', '#9e9e9e');
	}

});

/**
 * Ativa/Inativa formulário de convênios
 * Form: Pacientes
 * Aba: Informações de Convênio
 */
$('input[name="associado"]').unbind().bind('change', function () {

	if ($(this).prop('checked')) {
		$('#conv_medicus24h').removeClass('hide').find('input,select,textarea').attr('disabled', false);
	} else {
		$('#conv_medicus24h').addClass('hide').find('input,select,textarea').attr('disabled', true);
	}

});

/**
 * Tabela de relação de planos de saúde vinculados ao perfil do paciente
 * Form: Pacientes
 * Aba: Planos
 */
$('#plano_saude').find('tbody').find('tr').find('input:radio').unbind().bind('change', function () {

	$.ajax({
		url: $(this).data('url'),
		datatype: 'ajax',
		data: {
			default: $(this).val()
		},
		success: (response) => {
			alert(response);
		}
	});

});

$('#form_plano_saude').find('form').unbind().bind('submit', function (e) {

	e.preventDefault();

	var self = $(this);
	// var method = self.attr('method') || 'post';
	var method = self.find('[name="_method"]').val() || 'post';
	var action = self.attr('action') || null;
	var btn_submit = self.find(':submit');

	var tr = $('#plano_saude').find('tbody').find('tr');
	// var index = tr.length > 0 ? tr.attr('id') : 0;
	var index = $('#plano_saude').find('tbody').find('tr').length;

	self.ajaxSubmit({
		// method: method,
		action: action,
		// dataType: 'html',
		data: {
			// plano: index
		},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		beforeSend: (e) => {
			btn_submit.attr('disabled', true);
		},
		success: (response) => {

			var parser = new DOMParser();
			var content = parser.parseFromString(response.data, 'text/html');
			var row = content.querySelector('table > tbody > tr');

			$('#plano_saude').find('tbody').find('tr#convenio_vazio').hide();

			if (method == 'post') {

				$('#plano_saude').find('tbody').append(row);

			} else {

				var linhas = $('#plano_saude').find('tbody').find('tr');
				var index = $('#plano_saude').find('tbody').find('tr#' + response.index).index();

				linhas[index] = row;
				console.log(linhas, linhas[index]);

				$('#plano_saude').find('tbody').html(linhas);

			}

			$('#form_plano_saude').find('[type="reset"]').click();

			f();

		},
		error: (error) => {

			var errors = error.responseJSON;
			Form.clearErrors(self);
			Form.showErrors(self, errors, 'error');

			btn_submit.attr('disabled', false);
			progress('out')

		}

	});

});

$('[data-trigger="activator"]').unbind().bind('click', function () {

	var id = $(this).data('target');

	$('#' + id).click()

})
