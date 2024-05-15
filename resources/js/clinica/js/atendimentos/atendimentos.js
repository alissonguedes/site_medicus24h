$('#atendimento').Requests();
$('[data-tooltip]').tooltip();
$('[data-trigger="campaign"]').bind('click', function() {

	var $this = $(this);
	// var call = document.getElementById('painel_call');
	// var duration = call.duration * 1000 - 2000;

	// call.play();
	// $this.attr('disabled', true);
	$this.find('.material-symbols-outlined').text('play_arrow');
	M.toast({
		html: 'Chamando paciente...',
		classes: 'center',
		panning: true
	});

	console.log($this.data('href'))

	$.ajax({
		url: $this.data('href'),
		method: 'get',
		success: (response) => {
			console.log(response);
		}
	});

	setTimeout(function() {
		$this.attr('disabled', false);
		console.log(duration);
		$this.find('.material-symbols-outlined').text('campaign')
	}, duration);

})
