var button = $('#criar-tarefa');
var modal = $('#modal_tarefa');
var table = $('#table_tarefas');

// Excluir a tarefa da tabela. Não deleta diretamente no banco de dados.
function delete_tarefa() {
	$('#table_tarefas').find('[name="deletar"]').unbind().bind('click', function() {
		$(this).parents('tbody').find('.nenhum_registro').show()
		$(this).parents('tr').remove();
	});
}

delete_tarefa();

// Modal para a janela de tarefas
var modal_tarefa = modal.modal({

	onOpenEnd: (e) => {

		$(e).find('input,textarea,select').on('keydown', function(e) {
			if (e.keyCode === 13) {
				e.preventDefault();
				$(this).parents('.modal').find('button.save').click();
			}
		});

	},
	onCloseStart: (e) => {},
	onCloseEnd: (e) => {

		$(modal).find('input,textarea,select').each((b, a) => {

			a.value = '';

			if (a.tagName === 'SELECT')
				$(a).val('Profissionais responsáveis').formSelect().trigger('change');

			$(modal).find('.input-field label+input[type="text"]')
				.parents('.input-field')
				.find('label')
				.removeClass('active');

		});

		$(modal).find('.modal-content').find('.input-field').removeClass('error wrong').find('.error').remove();

	}
});

// Validar e adicionar a tarefa à tabela. Não salva no banco neste momento.
var btn = modal.find('.modal-footer .save').unbind().bind('click', function() {

	var data = {};
	var values = [];
	var inputs = $('#modal_tarefa').find('.modal-content').find('input,select,textarea');

	inputs.each(function() {

		if ($(this).is(':valid') || $(this).is(':checked')) {

			var name = $(this).attr('name');

			Object.assign(data, {
				[name]: $(this).val()
			});

		}

	});

	$.ajax({

		method: 'post',
		// datatype: 'html',
		url: $(this).data('url'),
		data: inputs.serialize(),
		headers: {
			'X-CSRF-Token': $('[name="_token"]').val(),
		},
		success: function(response) {

			var table = $(response).find('tbody').html();

			$('#modal_tarefa').find('.modal-content').find('.input-field').removeClass('error wrong').find('.error').remove();
			$('#table_tarefas').find('tbody').find('.nenhum_registro').hide().parent().append(table);

			modal_tarefa.modal('close')

			delete_tarefa();

		},

		error: function(response) {

			var errors = response.responseJSON.errors;
			$('#modal_tarefa').find('.modal-content').find('.input-field').removeClass('error wrong').find('.error').remove();

			for (var i in errors) {

				var input = $('#modal_tarefa').find('.modal-content').find(`[name="${i}"]`);

				input.parents('.input-field').addClass('error').append(`<div class="error">${errors[i][0]}</div>`);

			}

		}

	})

});

// Clicar no botão de adicionar tarefa
button.bind('click', function() {

	modal_tarefa.modal('open');

});
