<link rel="stylesheet" href="{{ asset('assets/node_modules/select2/dist/css/select2.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/defaults/select2.css') }}">
<script src="{{ asset('assets/node_modules/select2/dist/js/select2.js') }}"></script>

<script>
	$(function() {
		// $('[name="nome_paciente"]').unbind().bind('keyup', function() {
		// 	$.ajax({
		// 		url: BASE_URL + 'homecare/pacientes/' + $(this).val(),
		// 		success: function(response){
		// 			console.log
		// 		}
		// 	})
		// })
		// $('select[name="nome_paciente"]').on('change', function() {
		// });
	})
</script>
{{--
<link rel="stylesheet" href="{{ asset('assets/node_modules/materialize-css/extras/noUiSlider/nouislider.css') }}">
<script src="{{ asset('assets/node_modules/materialize-css/extras/noUiSlider/nouislider.js') }}"></script>
<script src="{{ asset('assets/js/clinica/homecare/gestao_cuidados.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/clinica/homecare/modal_tarefas.js') }}"></script> --}}

{{-- <script>
		$(function() {

			function delete_convidado() {
				$('#lista_convidados').find('[name="deletar"]').unbind().bind('click', function() {
					$(this).parents('tr').remove();
				});
			}

			delete_convidado();

			var modal_tarefa = $('#modal_tarefa').modal({

				onCloseStart: function() {
					$('#modal_tarefa').find('.modal-content').find('.input-field input:not([placeholder]),.input-field textarea').parent().find('label').removeClass('active')
					$('#modal_tarefa').find('.modal-content').find('input:not([type="checkbox"]):not([type="radio"]),select,textarea').val('');
					$('#modal_tarefa').find('.modal-content').find('select').val('Classe do convidado').formSelect().trigger('change');
					$('#modal_tarefa').find('.modal-content').find('input:checkbox,input:radio').prop('checked', false).change();
					$('#modal_tarefa').find('.modal-content').find('.input-field').removeClass('invalid wrong').find('.invalid').remove();
				}

			});



		});
	</script> --}}
