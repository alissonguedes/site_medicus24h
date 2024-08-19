<table>
	<thead>
		<tr>
			<th class="left-align">Nome</th>
			<th class="left-align">Especialidades</th>
			<th class="center-align">Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($profissionais as $row)
			@php
				$especs = [];
				$especialidade = null;
				$especialidades = DB::connection('medicus')
				    ->table('tb_medico_especialidade')
				    ->select(DB::raw('(SELECT especialidade FROM tb_especialidade WHERE id = id_especialidade) AS especialidade'))
				    ->where('id_profissional', $row->id)
				    ->get();

				if ($especialidades->count() > 0) {
				    foreach ($especialidades as $e) {
				        $especs[] = $e->especialidade;
				        $especialidade = $e->especialidade;
				    }
				}
			@endphp
			<tr>
				<td>{{ $row->nome }}</td>
				<td>
					{{ $especialidade ?? 'Não informado' }}
					@if ($especialidades->count() > 1)
						<span class="badge blue" data-badge-caption="+{{ $especialidades->count() - 1 }}" data-tooltip="{{ implode(';<br>', $especs) }}." style="border-radius: 24px; color: #fff; width: 15px !important; display: inline-block; margin-left: 5px; cursor: pointer;"></span>
					@endif
				</td>
				<td class="center-align">
					<span class="badge new {{ $row->status === '0' ? 'red' : null }}" data-badge-caption="">{{ $row->status === '0' ? 'Inativo' : 'Ativo' }}</span>
				</td>
				<td class="center-align">
					<button class="btn btn-small btn-flat btn-edit btn-floating transparent" data-href="{{ route('clinica.profissionais.edit', $row->id) }}" data-tooltip="Editar" data-trigger="form" data-target="main-form">
						<i class="material-symbols-outlined grey-text">edit</i>
					</button>
					<button type="button" class="btn-small btn-flat btn-floating excluir transparent" data-trigger="delete" data-id="{{ $row->id }}" data-target="especialidade_{{ $row->id }}" data-tooltip="Remover">
						<i class="material-icons grey-text">delete</i>
					</button>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
