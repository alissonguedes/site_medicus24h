<x-clinica-layout>

	<x-slot:icon> real_estate_agent </x-slot:icon>
	<x-slot:title> Programas </x-slot:title>

	<x-header-page>
		<x-slot:search data-url="{{ route('clinica.homecare.gestao-de-cuidados.search') }}" placeholder="Pesquisar programas..."></x-slot:search>
		<x-slot:add_button data-href="{{ route('clinica.homecare.gestao-de-cuidados') }}" data-tooltip="Adicionar Programa">add</x-slot:add_button>
	</x-header-page>

	<x-slot:body>

		<div class="row">

			<div class="col s12">
				@if (isset($programas) && $programas->count() > 0)
					<table>
						<thead>
							<tr>
								<th>Nome do programa</th>
								<th class="center-align">Público alvo</th>
								<th class="center-align">Faixa etária</th>
								<th class="center-align"></th>
							</tr>
						</thead>
						<tbody>
							@props(['sexo' => ['A' => 'Indiferente', 'M' => 'Homens', 'F' => 'Mulheres']])
							@foreach ($programas as $row)
								<tr>
									<td>{{ $row->titulo }}</td>
									<td class="center-align">{{ $sexo[$row->publico] }}</td>
									<td class="center-align">
										@if ($row->idade_min == 0 && $row->idade_max >= 99)
											Todas as idades
										@else
											De {{ $row->idade_min }} a {{ $row->idade_max }} anos
										@endif
									</td>
									<td class="center-align">
										<button class="btn btn-flat btn-floating edit transparent waves-effect" data-href="{{ route('clinica.homecare.gestao-de-cuidados.edit', $row->id) }}" data-tooltip="Editar" data-trigger="form" data-target="main-form">
											<i class="material-symbols-outlined">edit</i>
										</button>

										<button type="button" class="btn btn-flat btn-floating delete transparent waves-effect" data-trigger="delete" data-id="{{ $row->id }}" data-target="programa_{{ $row->id }}" data-tooltip="Remover">
											<i class="material-symbols-outlined">delete</i>
										</button>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					<div class="col s12">
						Nenhum programa cadastrado.
					</div>
				@endif
			</div>
		</div>

	</x-slot:body>

	@php
		$responsaveis = [];
		$responsavel_tarefa = [];
		if (request('id')) {
		    $programaModel = App\Models\Clinica\ProgramaModel::from('tb_programas_responsavel')->where('id_programa', request('id'))->get();

		    if ($programaModel->count() > 0) {
		        foreach ($programaModel as $r) {
		            $responsaveis[] = $r->id_profissional;
		        }
		    }
		}

		$profissionais = [
		    [
		        'id' => '1',
		        'nome' => 'Alisson',
		    ],
		    [
		        'id' => '2',
		        'nome' => 'Guedes',
		    ],
		    [
		        'id' => '3',
		        'nome' => 'Pereira',
		    ],
		];

	@endphp

	@include('clinica.homecare.gestao-de-cuidados.includes.form')

</x-clinica-layout>
