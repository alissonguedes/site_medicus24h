<x-clinica-layout>

	<x-slot:icon> people </x-slot:icon>
	<x-slot:title> Pacientes </x-slot:title>

	<x-header-page>
		<x-slot:search data-url="{{ route('clinica.pacientes.search') }}" placeholder="Pesquisar pacientes..."></x-slot:search>
		<x-slot:add_button data-href="{{ route('clinica.pacientes.index') }}" data-tooltip="Adicionar Paciente">add</x-slot:add_button>
	</x-header-page>

	<x-slot:action>
		@php
			$dados = new App\Models\Clinica\PacienteModel();
		@endphp

		<div class="row">
			<div class="col s6"></div>
			<div class="col s6 right-align">
				{{ $dados->get()->total() }} Pacientes cadastrados
				·
				{{ $dados->where('status', '1')->count() }} ativos
				·
				{{ $dados->where('status', '0')->count() }} inativos
			</div>
		</div>
	</x-slot:action>

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
