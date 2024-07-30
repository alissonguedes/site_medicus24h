var button = document.getElementById('criar-tarefa');
var modal = document.getElementById('modal_tarefa');

button.addEventListener('click', function() {

	var tarefa = M.Modal.init(modal, {

		onCloseStart: () => {

			console.log($);
			alert('teste' + $)

		}

	});

	tarefa.open();

}, false);
