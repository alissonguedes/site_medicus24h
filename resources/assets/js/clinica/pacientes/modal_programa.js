$('#homecare').find('button[type="button"]').unbind().bind('click', function() {
	var id = $(this).attr('id').split('-')[1]

	var modal = $('#modal_' + id).modal({
		onCloseStart: function() {

		}
	});

	modal.modal('open');

});
