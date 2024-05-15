if ($('select[name="nome_paciente"]').length) {

	$('#nome_paciente').on('change', function () {

		var id = $(this).val();

		$('input[name="paciente"]').val(id);

		var reg = /\d/;

		$.ajax({
			url: BASE_URL + 'pacientes/' + id + '/dados',
			method: 'get',
			success: (response) => {

				if (reg.test(id)) {

					for (var i in response) {

						var val = response[i] ? response[i] : '-';
						var input = $('[name="' + i + '"]')


						input.val(val)
							.parent()
							.attr('readonly', true)
							.find('label')
							.addClass('active');

					}

				} else {

					alert({ 'title': 'Paciente não cadastrado!', 'message': 'Complete o cadastro do paciente preenchendo os campos obrigatórios.' });

					for (var i in response) {

						var val = response[i] ? response[i] : '';
						var input = $('[name="' + i + '"]')

						input.val('')
							.attr('readonly', false)
							.parent('.input-field')
							.find('label')
							.removeClass('active')

					}

				}

			}

		})


		if (reg.test(id)) {


		}

	});

}
