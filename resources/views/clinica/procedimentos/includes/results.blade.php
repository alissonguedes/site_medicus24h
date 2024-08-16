<table>
	<thead>
		<tr>
			<th class="center-align">Procedimento</th>
			<th class="center-align">Tipo</th>
			<th class="center-align">Tempo</th>
			<th class="center-align">Valor</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($procedimentos as $row)
			@php
				$categoria = DB::connection('medicus')
				    ->table('tb_categoria_descricao')
				    ->select('titulo')
				    ->where('id_categoria', $row->id_categoria)
				    ->first();
			@endphp
			<tr>
				<td>{{ $row->titulo }}</td>
				<td class="center-align">{{ $categoria->titulo }}</td>
				<td class="center-align">{{ $row->tempo }} {{ ($row->formato === 'm' ? 'minuto' : ($row->formato === 'h' ? 'hora' : null)) . ($row->tempo > 1 ? 's' : '') }}</td>
				<td class="center-align">R$ {{ number_format($row->valor, 2, ',', '.') }}</td>
				<td class="center-align">
					<button class="btn btn-small btn-flat btn-edit btn-floating transparent" data-href="{{ route('clinica.procedimentos.edit', $row->id) }}" data-tooltip="Editar" data-trigger="form" data-target="main-form">
						<i class="material-symbols-outlined grey-text">edit</i>
					</button>
					<button type="button" class="btn-small btn-flat btn-floating excluir transparent" data-trigger="delete" data-id="{{ $row->id }}" data-target="procedimento_{{ $row->id }}" data-tooltip="Remover">
						<i class="material-icons grey-text">delete</i>
					</button>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
