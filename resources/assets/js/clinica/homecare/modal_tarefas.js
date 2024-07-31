var button = document.getElementById('criar-tarefa');
var modal = document.getElementById('modal_tarefa');

button.addEventListener('click', function() {

	var tarefa = M.Modal.init(modal, {

		onCloseStart: (e, f) => {

			e.children[0].querySelectorAll('input,textarea,select').forEach((a, b) => {
				console.log(a.value = '')
			});

		}

	});

	tarefa.open();

}, false);
