var button = document.querySelector('#criar-tarefa');
var modal = document.querySelector('#modal_tarefa');
var table = document.querySelector('#table_tarefas');

button.addEventListener('click', function() {

	// button.unbind().bind('click', function() {

	var tarefa = M.Modal.init(modal, {
		// var tarefa = modal.modal({

		onOpenEnd: (e) => {

			$('input,textarea,select').on('keydown', function(e) {

				if (e.keyCode === 13) {

					e.preventDefault();
					$(this).parents('.modal').find('button.save').click();

				}

			});

			$('#modal_tarefa').find('.modal-footer button.save').bind('click', function() {

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
						'X-CSRF-Token': '{{ csrf_token() }}',
					},
					success: function(response) {

						$('#modal_tarefa').find('.modal-content').find('.input-field').removeClass('error wrong').find('.error').remove();

						var table = $(response).find('tbody').html();

						$('#lista_convidados').find('tbody').append(table);

						modal_tarefa.modal('close')

						delete_convidado();

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

		},

		onCloseStart: (e) => {



		},

		onCloseEnd: (e) => {

			$(modal).find('input,textarea,select').each((b, a) => {

				a.value = '';

				if (a.tagName === 'SELECT')
					$(a).val('Profissionais responsáveis').formSelect().trigger('change');

				console.log($(a));

				// if (a.tagName === 'INPUT')
				if ($(a).attr('type') != 'checkbox' || $(a).attr('type') !== 'radio' || a.tagName !== 'SELECT')
					$(modal).find('input:not(.select-dropdown)').parents('.input-field').find('label').removeClass('active');

			});

			$(modal).find('.modal-content').find('.input-field').removeClass('error wrong').find('.error').remove();

		}

	});

	tarefa.open();
	// tarefa.modal('open');

	// });
	//
}, false);
