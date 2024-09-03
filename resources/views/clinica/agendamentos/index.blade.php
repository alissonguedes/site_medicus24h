<x-clinica-layout>

	<x-slot:icon> edit_calendar </x-slot:icon>
	<x-slot:title> Agenda Médica </x-slot:title>

	<x-slot:main>

		<div class="card agenda card-panel no-padding">

			<div class="card-content animated fadeIn">

				@if (!request('id_medico') || !request('id_clinica') || !request('id_especialidade') || !request('horario'))
					<div class="row">

						<div class="col s12 m6 l6">
							<div class="row">
								<div class="col s12">
									<p class="mb-3">
										Clique na data para ver as especialidades disponíveis.
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col s12">
									<div class="calendar_pk" data-url="{{ route('clinica.agendamentos.agenda.horarios') }}"></div>
								</div>
							</div>
						</div>

						<div class="col s12 m6 l6" style="position: relative; overflow: hidden;">

							{{-- <h5 for="f_medico" class="no-margin flex flex-center">
							<i class="material-symbols-outlined mr-1" style="font-size: 32px; line-height: 32px; ">filter_alt</i> Filtros
						</h5>
						<div class="input-field">
							<select name="medico" id="f_medico" class="autocomplete" data-url="{{ route('clinica.recursosmedicos.agenda.busca.medico_especialidade') }}" placeholder="Buscar por médico ou especialidade"></select>
						</div> --}}

							@if (request('year') && request('month') && request('day'))

								<ol>
									@foreach ($clinicas as $c => $especialidades)
										<li>
											Clínica: {{ $c }}
											<ol>
												@foreach ($especialidades as $especialidade => $dados)
													<li>
														{{ $especialidade }}
														<ol>
															@foreach ($dados as $v)
																<li class="flex flex-center">
																	{{ $v['medico'] }} -
																	{{-- {{ $v['medico'] }} - <x-nav-link href="{{ route('clinica.agendamento.marcar_consulta', [request('year'), request('month'), request('day'), $v['id_especialidade'], $v['id_medico']]) }}">Ver horários disponíveis</x-nav-link> --}}
																	{{--  <a href="#modal-horarios-{{ $v['id_especialidade'] }}-{{ $v['id_medico'] }}" class="modal-trigger" data-trigger="modal-horarios">Ver horários disponíveis</a> --}}
																	<a class="card-title activator blue-text no-padding no-margin" data-url="{{ route('clinica.agendamentos.horarios', [request('year'), request('month'), request('day'), $v['id_medico'], $v['id_clinica'], $v['id_especialidade']]) }}" style="font-size: inherit; font-color: inherit; text-transform: inherit; font-family: inherit; font-weight: inherit; margin-left: 5px !important;">Ver horários disponíveis</a>
																</li>
															@endforeach
														</ol>
													</li>
												@endforeach
											</ol>
										</li>
									@endforeach
								</ol>

								<script>
									$('.modal').modal();
								</script>

							@endif

						</div>

					</div>

					<script>
						$(function() {
							$('.card-title.activator').bind('click', function() {

								var url = $(this).data('url');

								$.ajax({
									url: url,
									method: 'get',
									success: (response) => {
										$('#horarios.card-reveal').html(response);
									}
								});

							});
						})
					</script>
				@endif

			</div>

			<div id="horarios" class="card-reveal" style="z-index: 9999999999999999999999999;"></div>

			@if (request('id_medico') && request('id_clinica') && request('id_especialidade') && request('horario'))
				<div class="card-reveal no-padding" style="display: block; transform: translateY(-100%)">
					@include('clinica.agendamentos.form-agendamento')
				</div>
			@endif

			<style>
				.datepicker-controls button {
					display: flex;
					align-items: center;
					place-content: center;
					width: 32px;
					height: 32px;
					margin: 0 30px;
					border-radius: 24px;
				}

				#calendar_pk .datepicker-modal,
				#calendar_pk .modal-overlay {
					z-index: 1009 !important;
				}
			</style>

			@include('clinica.agendamentos.includes.scripts')

	</x-slot:main>

</x-clinica-layout>
