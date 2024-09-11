<x-clinica-layout>

	<x-slot:icon> user_attributes </x-slot:icon>
	<x-slot:title> Perfis de acesso </x-slot:title>

	<x-header-page>
		<x-slot:search data-url="{{ route('clinica.grupos.usuarios.search') }}" placeholder="Pesquisar perfis..."></x-slot:search>
		<x-slot:add_button data-href="{{ route('clinica.grupos.usuarios.index') }}" data-tooltip="Adicionar Perfil">add</x-slot:add_button>
	</x-header-page>

	<x-slot:body>

		<div class="row">
			@if (isset($perfis) && $perfis->count() > 0)
				@include('clinica.funcionarios.perfil_acesso.includes.results')
			@else
				<div class="col s12">
					Nenhum perfil cadastrado.
				</div>
			@endif
		</div>

	</x-slot:body>

	@include('clinica.funcionarios.perfil_acesso.includes.form')

</x-clinica-layout>
