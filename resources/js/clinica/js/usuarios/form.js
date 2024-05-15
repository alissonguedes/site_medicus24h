$('.browser-default').on('dblclick', function() {

	$(this).attr('readonly', false);
	$('a[href="#page-users-edit"]').hide();
	$('a[href="#page-users-edit-cancel"]').show();

});

$('a[href="#page-users-edit"]').bind('click', function(e) {

	e.preventDefault();

	$('.browser-default').dblclick();

});

$('a[href="#page-users-edit-cancel"]').bind('click', function(e) {

	e.preventDefault();

	$('.browser-default').attr('readonly', true);
	$('a[href="#page-users-edit"]').show();
	$('a[href="#page-users-edit-cancel"]').hide();

});
