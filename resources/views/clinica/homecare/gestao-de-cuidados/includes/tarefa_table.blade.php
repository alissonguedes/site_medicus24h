{{-- @dd($tarefa) --}}

@if (isset($tarefa))
	<table>
		<thead>
			<tr>
				<th class="center-align">Tarefa</th>
				<th class="center-align">Descrição</th>
				<th class="center-align">Prazo de conclusão</th>
				<th class="center-align">Tipo da tarefa</th>
				<th class="center-align">Responsáveis</th>
				<th class="center-align"></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="center-align">
					{{ $tarefa['titulo_tarefa'] }}
				</td>
				<td class="center-align">
					{{ $tarefa['descricao_tarefa'] }}
				</td>
				<td class="center-align">
					{{ $tarefa['prazo_tarefa'] }}
				</td>
				<td class="center-align">
					{{ $tarefa['tipo_tarefa'] }}
				</td>
				<td class="center-align">
					{{ $tarefa['responsavel_tarefa'] }}
				</td>

				<td class="center-align">
					<button type="button" name="deletar" class="browser-default">
						<i class="material-symbols-outlined">delete</i>
					</button>
				</td>

				@php
					$dados_tarefa = json_encode([
					    'titulo_tarefa' => $tarefa['titulo_tarefa'],
					    'descricao_tarefa' => $tarefa['descricao_tarefa'],
					    'prazo_tarefa' => $tarefa['prazo_tarefa'],
					    'tipo_tarefa' => $tarefa['tipo_tarefa'],
					    'responsavel_tarefa' => $tarefa['responsavel_tarefa'],
					]);
				@endphp
				<input type="hidden" name="tarefa[]" value="{{ $dados_tarefa }}">
			</tr>
		</tbody>
	</table>
@endif
