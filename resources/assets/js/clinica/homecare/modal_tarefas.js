var button = $('#criar-tarefa');
var modal = $('#modal_tarefa');
var table = $('#table_tarefas');

button.unbind().bind('click', function () {

	var tarefa = modal.modal({

		onOpenEnd: (e) => {

			$('input,textarea,select').on('keydown', function (e) {

				if (e.keyCode === 13) {

					e.preventDefault();
					$(this).parents('.modal').find('button.save').click();

				}

			});

		},

		onCloseStart: (e) => {



		},

		onCloseEnd: (e) => {

			modal.find('input,textarea,select').each((b, a) => {

				a.value = '';

				if (a.tagName === 'SELECT')
					$(a).val('Profissionais responsáveis').formSelect().trigger('change');

				console.log($(a));

				// if (a.tagName === 'INPUT')
				if ($(a).attr('type') != 'checkbox' || $(a).attr('type') !== 'radio' || a.tagName !== 'SELECT')
					modal.find('input:not(.select-dropdown)').parents('.input-field').find('label').removeClass('active');

			});

			$(modal).find('.modal-content').find('.input-field').removeClass('error wrong').find('.error').remove();

		}

	});

	tarefa.modal('open');

});
