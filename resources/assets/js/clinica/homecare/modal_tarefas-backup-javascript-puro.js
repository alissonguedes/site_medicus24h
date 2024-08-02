var button = document.querySelector('#criar-tarefa');
var modal = document.querySelector('#modal_tarefa');
var table = document.querySelector('#table_tarefas');

button.addEventListener('click', function() {

	var tarefa = M.Modal.init(modal, {

		onOpenEnd: (e) => {

			// $('input,textarea,select').on('keydown', function(e) {

			// 	if (e.keyCode === 13) {

			// 		e.preventDefault();
			// 		$(this).parents('.modal').find('button.save').click();

			// 	}

			// });

			document.querySelectorAll('input,textarea,select').forEach((a, b) => {

				a.addEventListener('keydown', function(e) {

					if (e.keyCode === 13) {

						e.preventDefault();

						var m = this.closest('.modal');
						var btn = m.querySelector('.modal-footer .save');

						btn.click();

					}

				})

			});

		},

		onCloseStart: (e) => {



		},

		onCloseEnd: (e) => {

			// modal.find('input,textarea,select').each((b, a) => {

			// 	a.value = '';

			// 	if (a.tagName === 'SELECT')
			// 		$(a).val('Profissionais responsáveis').formSelect().trigger('change');

			// 	console.log($(a));

			// 	// if (a.tagName === 'INPUT')
			// 	if ($(a).attr('type') != 'checkbox' || $(a).attr('type') !== 'radio' || a.tagName !== 'SELECT')
			// 		modal.find('input:not(.select-dropdown)').parents('.input-field').find('label').removeClass('active');

			// });

			// $(modal).find('.modal-content').find('.input-field').removeClass('error wrong').find('.error').remove();

		}

	});

	tarefa.open();

}, false);

button.click();

// Valida e Adiciona tarefa após clicar no botão salvar
modal.querySelector('.modal-footer .save').addEventListener('click', function(e) {

	console.log(e);

	var xhr = new XMLHttpRequest();

	var url = this.getAttribute('data-url');
	var csrf = this.getAttribute('data-token');

	console.log(url, csrf);

	xhr.open('post', url);

	xhr.setRequestHeader('Request-Type', 'xmlhttprequest');
	xhr.setRequestHeader('X-CSRF-TOKEN', csrf);

	xhr.onload = function() {

	}

	xhr.onloadend = function() {




	}

	xhr.send();

});
