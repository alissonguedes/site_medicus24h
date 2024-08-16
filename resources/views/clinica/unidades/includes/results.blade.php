<table>
	<thead>
		<tr>
			<th class="center-align">Nome da Empresa</th>
			<th class="center-align">CNPJ</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($unidades as $row)
			<tr>
				<td>{{ $row->razao_social }}</td>
				<td class="center-align">{{ $row->cnpj }}</td>
				<td class="center-align">
					<button class="btn btn-small btn-flat btn-edit btn-floating transparent" data-href="{{ route('clinica.unidades.edit', $row->id) }}" data-tooltip="Editar" data-trigger="form" data-target="main-form">
						<i class="material-symbols-outlined grey-text">edit</i>
					</button>
					<button type="button" class="btn-small btn-flat btn-floating excluir transparent" data-trigger="delete" data-id="{{ $row->id }}" data-target="clinica_{{ $row->id }}" data-tooltip="Remover">
						<i class="material-icons grey-text">delete</i>
					</button>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
