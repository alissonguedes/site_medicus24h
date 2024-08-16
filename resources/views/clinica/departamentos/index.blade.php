<x-clinica-layout>

	<x-slot:icon> account_tree </x-slot:icon>
	<x-slot:title> Centros de custo </x-slot:title>

	<x-header-page>
		<x-slot:search data-url="{{ route('clinica.departamentos.search') }}" placeholder="Pesquisar funcionários..."></x-slot:search>
		<x-slot:add_button data-href="{{ route('clinica.departamentos.index') }}" data-tooltip="Adicionar Funcionário">add</x-slot:add_button>
	</x-header-page>

	<x-slot:body>

		<div class="row">
			@if (isset($departamentos) && $departamentos->count() > 0)
				@include('clinica.departamentos.includes.results')
			@else
				<div class="col s12">
					Nenhum funcionário cadastrado.
				</div>
			@endif
		</div>

	</x-slot:body>

	@include('clinica.departamentos.includes.form')

</x-clinica-layout>
