<x-clinica-layout>

	<x-slot:icon> edit_calendar </x-slot:icon>
	<x-slot:title> Agenda Médica </x-slot:title>

	<x-slot:main>

		<div class="card card-panel no-padding">

			<div class="card-header animated fadeIn">
				@include('clinica.recursosmedicos.agenda.includes.card-header')
			</div>

			{{-- @php
				$agenda_medica = [];
				if (isset($horarios)) {
				    foreach ($horarios as $agenda) {
				        $id = $agenda->id;
				        $id_medico = $agenda->id_medico;
				        $medico = DB::connection('medicus')->table('tb_medico AS M')->select('nome')->join('tb_funcionario AS F', 'F.id', 'M.id_funcionario')->where('M.id_funcionario', $id_medico)->first();
				        $horarios = json_decode($agenda->horarios, true);
				        if ($horarios) {
				            foreach ($horarios as $dia => $hora) {
				                $agenda_medica[] = [
				                    'groupId' => $id_medico,
				                    'daysOfWeek' => [$dia],
				                    'title' => $medico->nome,
				                    // 'startTime'=> $h,
				                    // 'endTime'=> $h
				                ];
				            }
				        }
				    }
				}
			@endphp --}}

			<div class="card-content animated fadeIn">

				<div class="row">
					<div class="col s12 m6 l5">
						<input type="hidden" name="data" data-mask="calendar">
						<div class="calendar_pk"></div>
					</div>
					<div class="col s12 m6 l7">
						<h5 for="filtro" class="no-margin flex flex-center">
							<i class="material-symbols-outlined mr-1" style="font-size: 32px; line-height: 32px; ">filter_alt</i> Filtros
						</h5>
						<div class="input-field">
							<select name="medico" id="medico" class="autocomplete" data-url="{{ route('clinica.recursosmedicos.agenda.busca.medico_especialidade') }}" placeholder="Buscar por especialidade ou médico"></select>
							{{-- <select class="autocomplete" id="medico" data-href="{{ route('clinica.recursosmedicos.agenda.busca.medico_especialidade') }}" placeholder=""></select> --}}
						</div>
					</div>
				</div>

				{{-- @php

					$profissionais = new App\Models\Clinica\AgendaModel();

					$medicos = $profissionais->select('*')->from('tb_medico AS M')->join('tb_funcionario AS F', 'F.id', 'M.id_funcionario')->get();

				@endphp

				@if (isset($medicos) && $medicos->count() > 0)
					<table class="">
						<thead>
							<tr>
								<th class="center-align">Nome</th>
								<th class="center-align">Conselho</th>
								<th class="center-align">Especialidade</th>
								<th class="center-align"></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($medicos as $medico)
								@php
									$especialidade = $profissionais
									    ->select('especialidade')
									    ->from('tb_especialidade')
									    ->where('id', function ($query) use ($medico) {
									        $query
									            ->select('id_especialidade')
									            ->from('tb_medico_especialidade')
									            ->where('id_funcionario', $medico->id_funcionario);
									    })
									    ->first();
								@endphp
								<tr>
									<td> {{ $medico->nome }} </td>
									<td> {{ $medico->crm }} </td>
									<td> {{ $especialidade->especialidade }} </td>
									<td class="center-align">
										<button class="btn btn-flat transparent btn-floating black-text ml-3" data-href="{{ route('clinica.recursosmedicos.agenda.medico', $medico->id) }}" data-tooltip="Ver Agenda">
											<i class="material-symbols-outlined">view_agenda</i>
										</button>
										<button class="btn btn-flat transparent btn-floating black-text ml-3" data-href="{{ route('clinica.recursosmedicos.agenda.disponibilidade', $medico->id) }}" data-tooltip="Adicionar Disponibilidade" data-trigger="form" data-target="main-form">
											<i class="material-symbols-outlined">edit_calendar</i>
										</button>
										<button class="btn btn-flat transparent btn-floating black-text ml-3" data-href="{{ route('clinica.recursosmedicos.agenda.medico.agendamento', $medico->id) }}" data-tooltip="Agendamento" data-trigger="form" data-target="form-agendamento">
											<i class="material-symbols-outlined">calendar_add_on</i>
										</button>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@endif

			</div>

			<div id="formularios" class="card-reveal no-padding" style="{{ ($errors->any() || request()->routeIs('clinica.recursosmedicos.agenda.disponibilidade') || request()->routeIs('clinica.recursosmedicos.agenda.medico.agendamento') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);') . 'overflow:hidden; z-index: 9999999;' }}">
				@include('clinica.recursosmedicos.agenda.includes.main-form')
			</div> --}}

			</div>

			@include('clinica.recursosmedicos.agenda.includes.scripts')

			<style>
				.calendar_pk .modal.datepicker-modal {
					position: relative;
					box-shadow: none;
					top: 0 !important;
					left: auto !important;
					right: auto !important;
					transform: none !important;
					background-color: #fafafa;
					padding: 0;
					max-height: 100%;
					width: 100%;
					max-width: 100%;
					margin: 0;
					overflow-y: auto;
					border-radius: 2px;
					will-change: auto;
					border: 1px solid var(--grey-lighten-2);
				}

				.calendar_pk .modal-overlay,
				.calendar_pk .datepicker-footer,
				.calendar_pk .datepicker-date-display {
					display: none !important;
				}

				.calendar_pk .datepicker-controls,
				.calendar_pk .datepicker-table,
				.calendar_pk .datepicker-footer {
					width: 100%;
				}

				.calendar_pk .datepicker-calendar {
					padding: 0;
				}

				.datepicker-day-button {
					width: 40px;
					height: 40px;
					line-height: 40px;
					margin: 5px auto;
				}

				.datepicker-table td {
					/* border-radius: 26px !important;
					width: 32px;
					height: 32px;
					line-height: 32px; */
					width: 40px;
					height: 40px;
					line-height: 40px;
					margin: 5px auto;
				}

				.datepicker-table td.is-selected {
					background-color: unset;
					color: unset;
				}

				.datepicker-table td.is-selected .datepicker-day-button {
					background-color: #26a69a;
					color: #fff;
				}

				.datepicker-table-wrapper {
					padding: 0 15px 15px;
				}

				.datepicker-controls .selects-container .select-wrapper:first-child {
					float: right;
				}

				.datepicker-controls .selects-container .select-wrapper:first-child input {
					width: 130px;
				}

				.datepicker-controls .selects-container .select-wrapper:last-child {
					float: right;
				}

				.datepicker-controls .selects-container .select-wrapper:last-child input {
					width: 90px;
				}
			</style>
		@include('clinica.homecare.pacientes.includes.scripts')

			<script>
				$(function() {

					var container = $('.calendar_pk');
					var input = $('[type="hidden"][data-mask="calendar"]');

					var date = new Date();
					// var curDate = date.getDate();
					// var curMonth = (date.getMonth() < 10 ? '0' : null) + (date.getMonth() + 1);
					var curYear = date.getFullYear();

					// var yearRange = 50;

					container.each(function() {

						var self = $(this);

						var defaultDate = "{{ date('d/m/Y') }}".split('/');
						var minDate = defaultDate; // $(this).data('min-date') ? $(this).data('min-date').split('/') : null;
						var maxDate = null; // $(this).data('max-date') ? $(this).data('max-date').split('/') : null;
						var yearRange = minDate ? [minDate[2], curYear + 50] : maxDate ? [1900, curYear - 0] : [curYear - 50, curYear + 50];

						minDate = minDate ? new Date(minDate[2], minDate[1] - 1, minDate[0]) : null;
						maxDate = maxDate ? new Date(maxDate[2], maxDate[1] - 1, maxDate[0]) : null;
						defaultDate = defaultDate ? new Date(defaultDate[2], defaultDate[1] - 1, defaultDate[0]) : null;

						var pick = $(this).datepicker({
							showDaysInNextAndPreviousMonths: true,
							container: self,
							startView: 1,
							setDefaultDate: true,
							defaultDate: defaultDate,
							minDate: minDate,
							maxDate: maxDate,
							yearRange: yearRange,
							// showMonthAfterYear: true,
							i18n: {
								months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
								monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
								weekdays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
								weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
								weekdaysAbbrev: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
								cancel: 'Cancelar'
							},
							onSelect: function(date) {
								console.log(date);
								input.val(moment(date).format('YYYY-MM-DD'), date);
							},
						});

						pick.datepicker('open');

					});

					// var autocomplete = $('input[type="text"].autocomplete');
					// var autocomplete = document.querySelectorAll('[type="text"].autocomplete');

					// var instance = M.Autocomplete.init(autocomplete);
					// instance = M.Autocomplete.getInstance(instance);
					// var autocomplete = $('input[type="text"].autocomplete').autocomplete({
					// 	data: {
					// 		'teste': null,
					// 		'teste2': null
					// 	}
					// });

					// $('input[type="text"].autocomplete').each(function(e) {

					// 	$(this).on('keyup', function() {

					// 		$.ajax({
					// 			url: $(this).data('url'),
					// 			method: 'get',
					// 			data: {
					// 				search: $(this).val(),
					// 			},
					// 			success: (response) => {
					// 				autocomplete.autocomplete('updateData',
					// 					{
					// 						'Teste': null,
					// 					}
					// 				);
					// 				autocomplete.autocomplete('open');
					// 			}
					// 		});

					// 	});

					// });

				});
			</script>

	</x-slot:main>

</x-clinica-layout>
