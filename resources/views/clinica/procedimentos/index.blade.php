<x-clinica-layout>

	<x-slot:icon> stethoscope_check </x-slot:icon>
	<x-slot:title> Procedimentos </x-slot:title>

	<x-header-page>
		<x-slot:search data-url="{{ route('clinica.procedimentos.search') }}" placeholder="Pesquisar procedimentos..."></x-slot:search>
		<x-slot:add_button data-href="{{ route('clinica.procedimentos.index') }}" data-tooltip="Adicionar Procedimento">add</x-slot:add_button>
	</x-header-page>

	{{-- <x-slot:info>Total: {{ $procedimentos->count() }}</x-slot:info> --}}

	<x-slot:body>

		<div class="row">
			@if (isset($procedimentos) && $procedimentos->count() > 0)
				@include('clinica.procedimentos.includes.results')
			@else
				<div class="col s12">
					Nenhum procedimento cadastrado.
				</div>
			@endif
		</div>

	</x-slot:body>

	@include('clinica.procedimentos.includes.form')

</x-clinica-layout>
