<x-clinica-layout>

	<x-slot:icon> people </x-slot:icon>
	<x-slot:title> Especialidades </x-slot:title>

	<x-header-page>
		<x-slot:search data-url="{{ route('clinica.especialidades.search') }}" placeholder="Pesquisar especialidades..."></x-slot:search>
		<x-slot:add_button data-href="{{ route('clinica.especialidades.index') }}" data-tooltip="Adicionar Especialidade">add</x-slot:add_button>
	</x-header-page>

	<x-slot:action>Total: {{ $especialidades->count() }}</x-slot:action>

	<x-slot:body>

		<div class="row">
			@if (isset($especialidades) && $especialidades->count() > 0)
				@include('clinica.especialidades.includes.results')
			@else
				<div class="col s12">
					Nenhum especialidade cadastrado.
				</div>
			@endif
		</div>

	</x-slot:body>

	@include('clinica.especialidades.includes.form')

</x-clinica-layout>
