<x-clinica-layout>

	<x-slot:icon> real_estate_agent </x-slot:icon>
	<x-slot:title> Programas </x-slot:title>

	<x-header-page>
		<x-slot:search data-url="{{ route('clinica.homecare.gestao-de-cuidados.search') }}" placeholder="Pesquisar programas..."></x-slot:search>
		<x-slot:add_button data-href="{{ route('clinica.homecare.gestao-de-cuidados') }}">add</x-slot:add_button>
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

										<button type="button" class="btn btn-flat btn-floating delete transparent waves-effect" data-href="{{ route('clinica.homecare.gestao-de-cuidados.delete', $row->id) }}" data-target="programa_{{ $row->id }}" data-tooltip="Remover">
											<i class="material-symbols-outlined">delete</i>
										</button>

										<div id="programa_{{ $row->id }}" class="confirm_delete">
											<div class="card z-depth-4">
												<form action="{{ route('clinica.homecare.gestao-de-cuidados.delete') }}" method="post">
													@csrf
													<input type="hidden" name="_method" value="delete">
													<div class="card-content white-text">
														<input type="hidden" name="id" value="{{ $row->id ?? null }}">
														<p class="bold">Esta ação não poderá ser desfeita.</p>
														<br>
														<p>Tem certeza que deseja remover este programa?</p>
														{{-- <p>Programa {{ $row->titulo . ' - ' . $row->id }}</p> --}}
													</div>
													<div class="card-footer border-top grey-border border-lighten-3 padding-2">
														<button type="reset" id="cancel" class="btn white black-text waves-effect modal-close left">Cancelar</button>
														<button type="submit" id="confirm" class="btn red waves-effect right" style="align-items: center; display: flex; background-color: var(--red) !important;">Confirmar</button>
													</div>
												</form>
											</div>
										</div>

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
		{{--
		<div id="confirm_delete" class="modal modal-fixed-footer">
			<div class="modal-content">
				<h3>ATENÇÃO!!!</h3>
				<p>Tem certeza que deseja excluir este programa?</p>
				<p>Esta ação não poderá ser defeita.</p>
			</div>
			<div class="modal-footer border-top grey-border border-lighten-3">
				<button type="button" id="cancel" class="btn white black-text waves-effect modal-close left">Cancelar</button>
				<button type="button" id="confirm" class="btn red waves-effect">Confirmar</button>
			</div>
		</div> --}}

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
