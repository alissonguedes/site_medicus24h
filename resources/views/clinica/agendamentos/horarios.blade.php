@if (request('year') && request('month') && request('day'))

	@if (isset($agenda))
		@php
			$data = request('day') . '/' . request('month') . '/' . request('year');
			$medico = DB::connection('medicus')
			    ->table('tb_medico')
			    ->select('nome')
			    ->where('id', $agenda->id_medico)
			    ->first();
			$clinica = DB::connection('medicus')
			    ->table('tb_empresa')
			    ->select('razao_social')
			    ->where('id', $agenda->id_clinica)
			    ->first();
			$especialidade = DB::connection('medicus')
			    ->table('tb_especialidade')
			    ->select('especialidade')
			    ->where('id', $agenda->id_especialidade)
			    ->first();
			$horarios = DB::connection('medicus')
			    ->table('tb_medico_agenda_horario')
			    ->select('dia', 'inicio', 'fim')
			    ->where('id_agenda', $agenda->id)
			    ->where('dia', date('w', strtotime(str_replace('/', '-', $data))))
			    ->get();
		@endphp

		<h4>Agenda <i class="material-symbols-outlined right card-title">close</i></h4>
		<h5 class="no-margin">{{ $medico->nome }} - {{ $especialidade->especialidade }}</h5>

		<p class="mt-3 mb-3">Horarios disponíveis para o dia {{ $data }}</p>

		@if ($horarios->count() > 0)
			@foreach ($horarios as $h)
				@php
					$duracao = $agenda->duracao;
					$inicio = strtotime($h->inicio);
					$fim = strtotime($h->fim);
					$i = 0;
					$turno = date('H', $inicio) < 12 ? 'Manhã' : 'Tarde';
				@endphp

				<table>
					<thead>
						<tr>
							<th>Hora</th>
							<th>Reserva</th>
						</tr>
					</thead>
					<tbody>
						@for ($hora = date('H', $inicio); $hora < date('H', $fim); $hora++)
							@php
								$turno = $hora < 12 ? 'Manhã' : 'Tarde';
							@endphp
							@php
								$i = 0;
							@endphp
							@for ($minuto = 0; $minuto < 59 / $duracao; $minuto++)
								@php
									$h = $hora < 10 ? '0' . (int) $hora : $hora;
									$m = $minuto * $duracao < 10 ? '0' . $minuto * $duracao : $minuto * $duracao;
									$i++;
								@endphp
								<tr>
									<td style="vertical-align: top;" width="10px">
										{{ $h . ':' . $m }}
									</td>
									<td>
										@php
											$atendimento = DB::connection('medicus')
											    ->table('tb_atendimento AS A')
											    ->select('data', 'hora_agendada', DB::raw('(SELECT nome FROM tb_paciente WHERE id = A.id_paciente) as paciente'), DB::raw('(SELECT titulo FROM tb_empresa WHERE id = A.id_clinica) as clinica'))
											    ->where([
											        'id_medico' => $agenda->id_medico,
											        'id_especialidade' => $agenda->id_especialidade,
											        'id_clinica' => $agenda->id_clinica,
											        'data' => date('Y-m-d', strtotime(str_replace('/', '-', $data))),
											        'hora_agendada' => date('H:i:s', strtotime($h . ':' . $m)),
											    ])
											    ->get()
											    ->first();
										@endphp
										@if (!isset($atendimento))
											@php
												$year = request('year');
												$month = request('month');
												$day = request('day');
												$horario = strtotime(date('Y-m-d H:i:s', strtotime(request('year') . '-' . request('month') . '-' . request('day') . ' ' . $h . ':' . $m)));
												$link = route('clinica.agendamentos.form', [$year, $month, $day, $horario, $agenda->id_medico, $agenda->id_clinica, $agenda->id_especialidade]);
											@endphp
											<x-nav-link :href="$link">Reservar Horário</x-nav-link>
										@else
											{{ $atendimento->paciente }} <br> {{ $atendimento->clinica }} <br> {{ date('d/m/Y', strtotime($atendimento->data)) }} - {{ date('H:i', strtotime($atendimento->hora_agendada)) }}
										@endif
									</td>
								</tr>
							@endfor
						@endfor
					</tbody>
				</table>
				<br>
			@endforeach

		@endif

	@endif
@endif
