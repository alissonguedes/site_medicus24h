<x-clinica-layout>

	<x-slot:icon> real_estate_agent </x-slot:icon>
	<x-slot:title> Programas </x-slot:title>

	<x-slot:body>

		{{-- @if (session('message'))
			<x-slot:toast>{{ session('message') }}</x-slot:toast>
		@endif --}}

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
										<button class="btn btn-flat btn-floating edit transparent waves-effect" data-href="{{ route('clinica.homecare.gestao-de-cuidados.edit', $row->id) }}" data-tooltip="Editar">
											<i class="material-symbols-outlined">edit</i>
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

	@include('clinica.homecare.gestao-de-cuidados.includes.form')

</x-clinica-layout>
