<x-clinica-layout>

	<x-slot:icon> home_health </x-slot:icon>
	<x-slot:title> Unidades </x-slot:title>

	<x-header-page>
		<x-slot:search data-url="{{ route('clinica.unidades.search') }}" placeholder="Pesquisar unidades..."></x-slot:search>
		<x-slot:add_button data-href="{{ route('clinica.unidades.index') }}" data-tooltip="Adicionar Unidade">add</x-slot:add_button>
	</x-header-page>

	<x-slot:body>

		<div class="row">
			@if (isset($unidades) && $unidades->count() > 0)
				@include('clinica.unidades.includes.results')
			@else
				<div class="col s12">
					Nenhuma unidade cadastrada.
				</div>
			@endif
		</div>

	</x-slot:body>

	@include('clinica.unidades.includes.form')

</x-clinica-layout>
