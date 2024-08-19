<x-clinica-layout>

	<x-slot:icon> people </x-slot:icon>
	<x-slot:title> Profissionais </x-slot:title>

	<x-header-page>
		<x-slot:search data-url="{{ route('clinica.profissionais.search') }}" placeholder="Pesquisar profissionais..."></x-slot:search>
		<x-slot:add_button data-href="{{ route('clinica.profissionais.index') }}" data-tooltip="Adicionar Especialidade">add</x-slot:add_button>
	</x-header-page>

	<x-slot:action>Total: {{ $profissionais->count() }}</x-slot:action>

	<x-slot:body>

		<div class="row">
			@if (isset($profissionais) && $profissionais->count() > 0)
				@include('clinica.profissionais.includes.results')
			@else
				<div class="col s12">
					Nenhum especialidade cadastrado.
				</div>
			@endif
		</div>

	</x-slot:body>

	@include('clinica.profissionais.includes.form')

</x-clinica-layout>
