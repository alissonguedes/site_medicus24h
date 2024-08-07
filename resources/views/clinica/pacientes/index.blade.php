<x-clinica-layout>

	<x-slot:icon> people </x-slot:icon>
	<x-slot:title> Pacientes </x-slot:title>

	<x-header-page>
		<x-slot:search data-url="{{ route('clinica.pacientes.search') }}" placeholder="Pesquisar pacientes..."></x-slot:search>
		<x-slot:add_button data-href="{{ route('clinica.pacientes.index') }}" data-tooltip="Adicionar Paciente">add</x-slot:add_button>
	</x-header-page>

	{{-- <x-slot:info>Total: {{ $pacientes->count() }}</x-slot:info> --}}

	<x-slot:body>

		<div class="row">
			@if (isset($pacientes) && $pacientes->count() > 0)
				@include('clinica.pacientes.includes.results')
			@else
				<div class="col s12">
					Nenhum paciente cadastrado.
				</div>
			@endif

		</div>

	</x-slot:body>

	@include('clinica.pacientes.includes.form')

</x-clinica-layout>
