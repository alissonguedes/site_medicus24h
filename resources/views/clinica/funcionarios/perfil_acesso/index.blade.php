<x-clinica-layout>

	<x-slot:icon> people </x-slot:icon>
	<x-slot:title> Funcionários </x-slot:title>

	<x-header-page>
		<x-slot:search data-url="{{ route('clinica.funcionarios.search') }}" placeholder="Pesquisar funcionários..."></x-slot:search>
		<x-slot:add_button data-href="{{ route('clinica.funcionarios.index') }}" data-tooltip="Adicionar Funcionário">add</x-slot:add_button>
	</x-header-page>

	<x-slot:body>

		<div class="row">
			@if (isset($funcionarios) && $funcionarios->count() > 0)
				@include('clinica.funcionarios.includes.results')
			@else
				<div class="col s12">
					Nenhum funcionário cadastrado.
				</div>
			@endif
		</div>

	</x-slot:body>

	@include('clinica.funcionarios.includes.form')

</x-clinica-layout>
