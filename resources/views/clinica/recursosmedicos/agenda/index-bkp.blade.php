<x-clinica-layout>

	<x-slot:icon> edit_calendar </x-slot:icon>
	<x-slot:title> Agenda Médica </x-slot:title>

	<x-slot:main>

		<div class="card card-panel no-padding">

			<div class="card-header animated fadeIn">
				@include('clinica.recursosmedicos.agenda.includes.card-header')
			</div>

			<div class="card-content animated fadeIn">

				@php

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
				@else
					Nenhum registro encontrado.
				@endif

			</div>

			<div id="formularios" class="card-reveal no-padding" style="{{ ($errors->any() || request()->routeIs('clinica.recursosmedicos.agenda.disponibilidade') || request()->routeIs('clinica.recursosmedicos.agenda.medico.agendamento') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);') . 'overflow:hidden; z-index: 9999999;' }}">
				@include('clinica.recursosmedicos.agenda.includes.main-form')
			</div>

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

		<script>
			$(function() {

				var container = $('.calendar_pk');
				var input = $('[type="hidden"][data-mask="calendar"]');
				container.each(function() {

					var self = $(this);
					var pick = $(this).datepicker({
						showDaysInNextAndPreviousMonths: true,
						container: self,
						onSelect: function(date) {
							console.log(date);
							input.val(moment(date).format('YYYY-MM-DD'), date);
						}
					});

					pick.datepicker('open');

				})

			});
		</script>

	</x-slot:main>

</x-clinica-layout>
