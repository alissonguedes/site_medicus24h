<x-clinica-layout>

	<x-slot:icon> edit_calendar </x-slot:icon>
	<x-slot:title> Agenda Médica </x-slot:title>

	<x-slot:main>

		<div class="card card-panel no-padding">

			<div class="card-header animated fadeIn">
				@include('clinica.recursosmedicos.agenda.includes.card-header')
			</div>

			<div class="card-content animated fadeIn no-padding">
				<div id="calendar"></div>
			</div>

			<div id="formularios" class="card-reveal no-padding" style="{{ ($errors->any() || request('id') ? 'display: block; transform: translateY(-100%);' : 'display: none; transform: translateY(0%);') . 'overflow:hidden; z-index: 9999999;' }}">

				@include('clinica.recursosmedicos.agenda.includes.main-form')

			</div>

		</div>

		@include('clinica.recursosmedicos.agenda.includes.scripts')

	</x-slot:main>

</x-clinica-layout>
