<x-clinica-layout>

	<x-slot:icon> </x-slot:icon>
	<x-slot:title> </x-slot:title>

	<x-slot:body>

		<div class="row">

			<div class="col s12 m6 l6 xl3">
				<div class="card gradient-45deg-purple-deep-purple gradient-shadow min-height-100 white-text animate fadeLeft">
					<div class="padding-4">
						<div class="row">
							<div class="col s4 m4 center-align">
								<i class="material-symbols-outlined background-round mt-5">people</i>
								<p>Pacientes</p>
							</div>
							<div class="col s8 m8 right-align">
								<h5 class="mb-0 white-text">{{ App\Models\Clinica\PacienteModel::where('is_deleted', '0')->count() }}</h5>
								{{-- <p class="no-margin">Pacientes</p> --}}
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col s12 m6 l6 xl3">
				<div class="card gradient-45deg-purple-deep-purple gradient-shadow min-height-100 white-text animate fadeLeft">
					<div class="padding-4">
						<div class="row">
							<div class="col s4 m4 center-align">
								<i class="material-symbols-outlined background-round mt-5">real_estate_agent</i>
								<p>HomeCare</p>
							</div>
							<div class="col s8 m8 right-align">
								<h5 class="mb-0 white-text">{{ App\Models\Clinica\HomecareModel::count() }}</h5>
								{{-- <p class="no-margin">Pacientes</p> --}}
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col s12 m6 l6 xl3">
				<div class="card gradient-45deg-purple-deep-purple gradient-shadow min-height-100 white-text animate fadeLeft">
					<div class="padding-4">
						<div class="row">
							<div class="col s4 m4 center-align">
								<i class="material-symbols-outlined background-round mt-5">cardiology</i>
								<p>Atendimentos</p>
							</div>
							<div class="col s8 m8 right-align">
								<h5 class="mb-0 white-text">{{ App\Models\Clinica\AtendimentoModel::count() }}</h5>
								{{-- <p class="no-margin">Pacientes</p> --}}
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col s12 m6 l6 xl3">
				<div class="card gradient-45deg-purple-deep-purple gradient-shadow min-height-100 white-text animate fadeLeft">
					<div class="padding-4">
						<div class="row">
							<div class="col s4 m4 center-align">
								<i class="material-symbols-outlined background-round mt-5">stacked_inbox</i>
								<p>Tickets</p>
							</div>
							<div class="col s8 m8 right-align">
								<h5 class="mb-0 white-text">{{ App\Models\Tickets\TicketModel::count() }}</h5>
								{{-- <p class="no-margin">Pacientes</p> --}}
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</x-slot:body>

</x-clinica-layout>
