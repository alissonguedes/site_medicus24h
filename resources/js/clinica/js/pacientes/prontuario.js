'use strict';

$('[data-target="prontuario"]').bind('click', function () {
	console.log($(this).data('link'));
})

$('.reload').on('click', function () {
	var datatable = Datatable;
	datatable.reload();
});

$('[data-trigger="toggle"]').bind('click', function (e) {

	e.preventDefault();

	var id = $(this).attr('href');
	var div = $(this).parents(id).find('.registros-medicos');

	$('[data-trigger="toggle"]').removeClass('opened');

	if (div.is(':visible')) {
		div.hide();
	} else {
		$('.registros-medicos').hide();
		$(this).addClass('opened');
		div.show();
	}

});

