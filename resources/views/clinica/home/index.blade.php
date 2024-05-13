<x-clinica-layout>

	<x-slot:icon> dashboard </x-slot:icon>
	<x-slot:title> Dashboard </x-slot:title>

	<x-slot:body>
		<a href="{{ route('clinica.pacientes.index') }}">Pacientes</a>
	</x-slot:body>

	<x-slot:script>
		{{-- <script src="{{ asset('assets/scripts/app/clinica/core.js') }}"></script> --}}
	</x-slot:script>

</x-clinica-layout>
