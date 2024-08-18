<table>
	<thead>
		<tr>
			<th class="center-align">Funcionario</th>
			<th class="center-align">Departamento</th>
			<th class="center-align">Perfil</th>
			<th class="center-align">Status</th>
			<th class="center-align"></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($funcionarios as $row)
			@php
				$gp = DB::connection('system')
				    ->table('tb_acl_grupo')
				    ->select('grupo')
				    ->where('id', $row->perfil)
				    ->get()
				    ->first();
			@endphp
			<tr>
				<td>{{ $row->nome }}</td>
				<td class="center-align">{{ $row->nome }}</td>
				<td>{{ $gp->grupo ?? null }}</td>
				<td class="center-align">
					<span class="badge new {{ $row->status === '0' ? 'red' : null }}" data-badge-caption="">{{ $row->status === '0' ? 'Inativo' : 'Ativo' }}</span>
				</td>
				<td class="center-align">
					<button class="btn btn-small btn-flat btn-edit btn-floating transparent" data-href="{{ route('clinica.funcionarios.edit', $row->id) }}" data-tooltip="Editar" data-trigger="form" data-target="main-form">
						<i class="material-symbols-outlined grey-text">edit</i>
					</button>
					<button type="button" class="btn-small btn-flat btn-floating excluir transparent" data-trigger="delete" data-id="{{ $row->id }}" data-target="funcionario_{{ $row->id }}" data-tooltip="Remover">
						<i class="material-icons grey-text">delete</i>
					</button>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
