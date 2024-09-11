<x-clinica-layout>

	<x-slot:icon> edit_calendar </x-slot:icon>
	<x-slot:title> Agenda Médica </x-slot:title>

	<x-slot:main>

		<div class="card agenda card-panel no-padding">

			<div class="card-content animated fadeIn" style="height: calc(100% - 0px);">

				@if (!request('id_medico') || !request('id_clinica') || !request('id_especialidade') || !request('horario'))
					<div class="row">
						<div class="col s12">
							<p class="mb-3">
								Clique na data para ver as especialidades disponíveis.
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col s12 m6 l6">
							<div class="row">
								<div class="col s12">
									<div class="calendar_pk mb-3" data-url="{{ route('clinica.agendamentos.agenda.horarios') }}"></div>
								</div>
							</div>
							<div class="row">
								<div class="col s12">
									<button class="btn btn-large activator green waves-effect waves-light" data-trigger="activator" data-url="{{ route('clinica.agendamentos.horariosreservados', [request('year'), request('month'), request('day')]) }}">
										<i class="material-symbols-outlined left">calendar_clock</i>
										<span class="activator" style="font-family: inherit; font-size: inherit !important;">Ver horários agendados</span>
									</button>
								</div>
							</div>
						</div>

						<div class="col s12 m6 l6">
							{{--
								 <h5 for="f_medico" class="no-margin flex flex-center">
									<i class="material-symbols-outlined mr-1" style="font-size: 32px; line-height: 32px; ">filter_alt</i> Filtros
								</h5>
								<div class="input-field">
									<select name="medico" id="f_medico" class="autocomplete" data-url="{{ route('clinica.recursosmedicos.agenda.busca.medico_especialidade') }}" placeholder="Buscar por médico ou especialidade"></select>
								</div>
							 --}}
							@if (request('year') && request('month') && request('day'))
								<div class="row">
									@foreach ($clinicas as $clinica => $especialidades)
										<div class="col s12">
											<div class="card z-depth-0 mt-0" style="border: 1px solid var(--grey-lighten-2)">
												<div class="card-content">
													<h3 class="card-title" style="font-weight: 400; margin: 0 0 8px 0;">
														<i class="material-symbols-outlined left">location_on</i> {{ $clinica }}
													</h3>
													@foreach ($especialidades as $especialidade => $dados)
														<h4 style="font-size: 18px; font-weight: 400; margin: 30px 0 15px;">
															<i class="material-symbols-outlined left">stethoscope</i> {{ $especialidade }}
														</h4>
														@foreach ($dados as $v)
															<div id="card-stats" class="row">
																<div class="col s12 m6 l6 center-align">
																	<div class="card z-depth-0 waves-effect activator" data-trigger="activator" data-url="{{ route('clinica.agendamentos.horarios', [request('year'), request('month'), request('day'), $v['id_medico'], $v['id_clinica'], $v['id_especialidade']]) }}" style="width: 80%; margin: auto;">
																		<div class="card-content center-align">
																			<i class="material-symbols-outlined" style="padding: 24px; width: 80px; height: 80px; line-height: 80px; font-size: 70px; padding: 0; border-radius: 15px; background: var(--grey-lighten-2); margin: 0;">person</i>

																			<h5 class="card-stats-number mb-0" style="font-size: 18px; max-width: 80%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; margin: 15px auto;">{{ $v['medico'] }}</h5>
																			<span class="grey-text">{{ $v['especialidade'] }}</span>
																			<br>
																			<small>CRM: {{ $v['crm'] }}</small>
																		</div>
																		{{-- <div class="card-action darken-1" style="position: relative; border: 0;">
																			<a class="card-title activator blue-text no-padding no-margin center-align" data-trigger="activator" data-url="{{ route('clinica.agendamentos.horarios', [request('year'), request('month'), request('day'), $v['id_medico'], $v['id_clinica'], $v['id_especialidade']]) }}" style="font-size: inherit; font-color: inherit; text-transform: inherit; font-family: inherit; font-weight: inherit; margin-left: 5px !important;">Ver horários disponíveis</a>
																		</div> --}}
																	</div>
																</div>
															</div>
														@endforeach
													@endforeach
												</div>
											</div>
										</div>
									@endforeach
								</div>
							@endif

						</div>

					</div>

				@endif

			</div>

			<div class="card-reveal" @if (request('id_medico') && request('id_clinica') && request('id_especialidade') && request('horario')) style="display: block; transform: translateY(-100%)" @endif>

				<i class="card-title material-symbols-outlined right  @if (request('id_medico') && request('id_clinica') && request('id_especialidade') && request('horario')) hide @endif" style="position: absolute; right: 24px; top: 24px; z-index: 999999999999; width: 32px; height: 32px; line-height: 32px; border-radius: 24px; text-align: center; font-weight: 300;">close</i>

				<div id="horarios"></div>

				@if (request('id_medico') && request('id_clinica') && request('id_especialidade') && request('horario'))
					@include('clinica.agendamentos.form-agendamento')
				@endif

			</div>

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

			<script>
				$(function() {


					var anim = {
						transform: 'translateY(-100%)',
						transition: '250ms ease-in-out'
					};

					$('[data-trigger="activator"]').bind('click', function() {

						var url = $(this).data('url');
						$('.card-reveal').css({
							display: 'block',
						});
						$.ajax({
							url: url,
							method: 'get',
							success: (response) => {
								$('.card-reveal').css(anim).find('#horarios').html(response);
								$.getScript(BASE_PATH + 'assets/js/app.js');
							}
						});

					});

				})
			</script>

			@include('clinica.agendamentos.includes.scripts')

	</x-slot:main>

</x-clinica-layout>
