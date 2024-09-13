@php
	$meses = ['Janeiro', 'Fevereiro', 'Março', 'Maio', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

	$regex = preg_match('/^(\d){4}\-(([0]?)[0-9]|[1][0-2])\-([0-2][0-9]|[3][0-1])$/', $data);
	$datastr = $regex ? 'dia ' . date('d', strtotime($data)) . ' de ' . $meses[date('n', strtotime($data))] . ' de ' . date('Y', strtotime($data)) : 'mês de ' . $meses[date('n', strtotime($data))] . ' de ' . date('Y', strtotime($data));
@endphp

<div class="row">
	<div class="col s12">
		<h4 class="mb-2">Agendamentos para o {{ $datastr }}</h4>
	</div>
</div>

<script>
	$(function() {
		$('.dropdown-trigger').dropdown({
			coverTrigger: false,
			constrainWidth: false,
			alignment: 'right',
		});
		$('.modal-detalhes-agendamento').modal({
			onOpenStart() {
				$('.card.agenda').find('.card-reveal').css({
					'overflow': 'hidden'
				});
			},
			onCloseStart() {
				$('.card.agenda').find('.card-reveal').css({
					'overflow': 'auto'
				});
			}

		});
	});
</script>
<div class="row mb-2">
	<div class="col s6 right-align">
		<div class="input-field prefix mt-0 mb-0">
			<label for="search" class="material-symbols-outlined prefix" style="-webkit-transform: unset; -ms-transform: unset; transform: none; -webkit-transform-origin: unset; -ms-transform-origin: unset; transform-origin: unset;">search</label>
			<input type="search" id="search" data-url="" style="padding-left: 40px;" placeholder="Buscar por médico, especialidade, clínica ou paciente">
		</div>

		<script>
			$(function() {
				$('input[id="search"]').bind('keyup paste', delay(function() {
					$.ajax({
						url: "{{ route('clinica.agendamentos.horariosreservados', [request('year'), request('month'), request('day')]) }}",
						data: {
							search: $(this).val()
						},
						success(response) {
							var html = $(response).html();
							$('#results_horarios_reservados').html(html);
							$.getScript(BASE_PATH + 'assets/js/app.js');
						}
					});
				}, 300));
			});
		</script>
	</div>
	<div class="col s6 right-align">
		<a type="button" class="btn dropdown-trigger grey grey-text text-darken-4 lighten-5 border z-depth-0 waves-effect" data-target="dropdown1">
			<i class="material-symbols-outlined left">sort</i>
			<span>Data e Hora</span>
		</a>
		<ul id="dropdown1" class="dropdown-content">
			<li><a href="#!"><i class="material-symbols-outlined">event</i>Data e Hora</a></li>
			<li><a href="#!"><i class="material-symbols-outlined">medical_information</i>Médico</a></li>
			<li><a href="#!"><i class="material-symbols-outlined">stethoscope</i>Especialidade</a></li>
			<li><a href="#!"><i class="material-symbols-outlined">location_on</i>Clínica</a></li>
			<li><a href="#!"><i class="material-symbols-outlined">person</i>Paciente</a></li>
		</ul>
	</div>
</div>

@if ($agenda->count() > 0)
	@include('clinica.agendamentos.results_horarios_reservados')
@else
	<p>Não há agendamentos para {{ $regex ? 'esta data' : 'este mês' }}.</p>
@endif
