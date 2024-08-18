<table>
	<thead>
		<tr>
			<th class="left-align">Departamento</th>
			<th class="center-align">Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($departamentos as $row)
			@php
				$categoria = DB::connection('medicus')
				    ->table('tb_categoria_descricao')
				    ->select('titulo')
				    ->where('id_categoria', $row->id_categoria)
				    ->first();
			@endphp
			<tr>
				<td>{{ $row->titulo }}</td>
				<td class="center-align">
					<span class="badge new {{ $row->status === '0' ? 'red' : null }}" data-badge-caption="">{{ $row->status === '0' ? 'Inativo' : 'Ativo' }}</span>
				</td>
				<td class="center-align">
					<button class="btn btn-small btn-flat btn-edit btn-floating transparent" data-href="{{ route('clinica.departamentos.edit', $row->id) }}" data-tooltip="Editar" data-trigger="form" data-target="main-form">
						<i class="material-symbols-outlined grey-text">edit</i>
					</button>
					<button type="button" class="btn-small btn-flat btn-floating excluir transparent" data-trigger="delete" data-id="{{ $row->id }}" data-target="departamento_{{ $row->id }}" data-tooltip="Remover">
						<i class="material-icons grey-text">delete</i>
					</button>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
