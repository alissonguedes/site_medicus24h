<x-clinica-layout>

	<x-slot:icon> people </x-slot:icon>
	<x-slot:title> Pacientes </x-slot:title>

	{{-- <x-slot:info>Total: {{ $pacientes->count() }}</x-slot:info> --}}

	<x-slot:body>

		{{-- {!! make_menu('main-menu', 'clinica') !!} --}}

	</x-slot:body>

	@include('clinica.pacientes.includes.form')

</x-clinica-layout>
