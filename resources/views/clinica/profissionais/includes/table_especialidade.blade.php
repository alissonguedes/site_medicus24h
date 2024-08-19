@if (isset($especialidades))
	<table>
		<thead>
			<tr>
				<th class="center-align">Especialidade</th>
				<th class="center-align">RQE</th>
				<th class="center-align">Conselho</th>
				<th class="center-align">Registro</th>
				<th class="center-align">UF</th>
				<th class="center-align">Ação</th>
			</tr>
		</thead>
		<tbody>
			@php
				$especialidade = DB::connection('medicus')
				    ->table('tb_especialidade')
				    ->select('especialidade')
				    ->where('id', $especialidades['especialidade'])
				    ->first();
			@endphp
			<tr>
				<td class="center-align">{{ $especialidade->especialidade }}</td>
				<td class="center-align">{{ $especialidades['rqe'] ?? 'Não informado' }}</td>
				<td class="center-align">{{ $especialidades['conselho'] ?? 'Não informado' }}</td>
				<td class="center-align">{{ $especialidades['registro'] ?? 'Não informado' }}</td>
				<td class="center-align">{{ $especialidades['uf_registro'] ?? 'Não informado' }}</td>
				<td class="center-align">
					<input type="hidden" name="especialidade[]" value="{{ json_encode($especialidades) }}">
					<button type="button" class="btn btn-flat btn-floating transparent waves-effect">
						<i class="material-symbols-outlined">delete</i>
					</button>
				</td>
			</tr>
		</tbody>
	</table>
@endif
