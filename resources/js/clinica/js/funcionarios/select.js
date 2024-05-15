$('select[name="clinica"]').on('change', function() {
	$('select[name="departamento"]')
		.val('')
		.attr('disabled', false)
		.select2({
			ajax: {
				url: $('select[name="departamento"]').data('url'),
				dataType: 'json',
				data: (data) => {
					return {
						clinica: $('select[name="clinica"]').val(),
						query: data.term || null,
					}
				},
				processResults: function(data, params) {
					params.page = params.page || 1;
					return {
						results: data.items,
						pagination: {
							more: (params.page * 30) < data.total_count
						}
					};
				},
			}
		});
});

$('select[name="funcao"]').on('change', function() {

	if ($(this).val() == 2) {
		$('#dados_medicos').show().find('[disabled]').attr('disabled', false);
	} else {
		$('#dados_medicos').hide().find('input,select').val('').trigger('change');
		$('#dados_medicos').hide().find('input,select').attr('disabled', true);
	}

})
