<x-clinica-layout>

	<x-slot:icon> real_estate_agent </x-slot:icon>
	<x-slot:title> Programas </x-slot:title>

	<x-slot:body>

		<div class="row">
			@if (isset($pacientes) && $pacientes->count() > 0)
				@include('clinica.pacientes.includes.results')
			@else
				<div class="col s12">
					Nenhum paciente cadastrado nesta modalidade.
				</div>
			@endif
		</div>

	</x-slot:body>

	@include('clinica.homecare.pacientes.includes.form')

</x-clinica-layout>
