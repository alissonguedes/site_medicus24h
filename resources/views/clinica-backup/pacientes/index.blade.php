<x-clinica-layout>

	<x-slot:icon> people </x-slot:icon>
	<x-slot:title> Pacientes </x-slot:title>

	<x-slot:body>

		<div class="row">
			@if (isset($pacientes) && $pacientes->count() > 0)
				@foreach ($pacientes as $row)
					<div class="col s12 m6 l4 card-width">
						<div class="profile-card card card-border center-align border-radius-6 z-depth-0 gradient-45deg-teal-teal gradientshadow">
							<div class="card-content white-text">

								@php
									if (!isset($row->status) || (isset($row->status) && $row->status === '0')):
									    $style = 'opacity: 0.6; filter: grayscale(1)';
									endif;
								@endphp

								<img src="{{ asset($row->imagem ?? (!isset($row->sexo) || (isset($row->sexo) && is_null($row->sexo)) ? 'assets/img/avatar/avatar-0.png' : ($row->sexo == 'M' ? 'assets/img/avatar/homem.png' : 'assets/img/avatar/mulher.png'))) }}" class="responsive-img circle z-depth-4" style="{{ $style ?? null }}" alt="" width="100">
								<h5 class="title white-text mt-0 uppercase" style="max-width: 100%">{{ $row->nome ?? null }}</h5>

								@if (isset($row->status) && $row->status === '0')
									<div class="btn btn-floating gradient-45deg-red-pink" style="position: absolute; right: 18px; top: 18px; font-size: 24px;">
										<i class="material-symbols-outlined teal-text" style="font-size: inherit; color: #fff !important;">lock</i>
									</div>
								@endif

								<p class="mt-8">
									<span class="flex flex-center" title="CPF"><i class="material-symbols-outlined">credit_card</i> {{ $row->cpf ?? 'Não informado' }}</span>
									<span class="flex flex-center" title="Matrícula"><i class="material-symbols-outlined">medical_information</i> {{ $row->matricula ?? 'Não informado' }}</span>
									<span class="flex flex-center" title="Telefone"><i class="material-symbols-outlined">phone</i> {{ $row->celular ?? ($row->telefone ?? 'Não informado') }}</span>
									<span class="flex flex-center" title="Whatsapp"><i class="material-symbols-outlined">message</i>{{ $row->celular ?? ($row->telefone ?? 'Não informado') }}</span>
									<span class="flex flex-center" title="E-mail"><i class="material-symbols-outlined">mail</i> {{ $row->email ?? 'Não informado' }} </span>
									<span class="flex flex-center" title="Data de nascimento"><i class="material-symbols-outlined">cake</i>{{ $row->data_nascimento ?? 'Não informado' }}</span>
								</p>
								<div class="row mt-5">
									<div class="col s4">
										<h5 class="icon-background pointer circle white-text gradient-45deg-indigo-light-blue z-depth-3 mx-auto waves-effect waves-light" data-href="#" data-tooltip="Prontuário">
											<i class="material-symbols-outlined">assignment_ind</i>
										</h5>
									</div>
									<div class="col s4">
										<h5 class="icon-background pointer circle white-text gradient-45deg-deep-orange-orange z-depth-3 mx-auto waves-effect waves-light" data-href="#" data-tooltip="Agendamento" data-target="agendamento" data-trigger="form-sidenav">
											<i class="material-symbols-outlined">event</i>
										</h5>
									</div>
									<div class="col s4">
										{{-- <h5 class="icon-background pointer circle white-text gradient-45deg-indigo-blue z-depth-3 mx-auto waves-effect waves-light" data-href="{{ route('clinica.pacientes.edit', $row->id) }}" data-tooltip="Editar"> --}}
										<h5 class="icon-background pointer circle white-text gradient-45deg-indigo-blue z-depth-3 mx-auto waves-effect waves-light" data-url="{{ route('clinica.pacientes.edit', $row->id) }}" data-tooltip="Editar">
											<i class="material-symbols-outlined">edit</i>
										</h5>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			@endif
		</div>

	</x-slot:body>

	@include('clinica.pacientes.includes.form')

	<x-slot:script>
		<x-modal id="form_plano_saude">
			Teasdfste
		</x-modal>
		{{-- <script type="text/javascript" src="{{ asset('assets/node_modules/froala-editor/js/froala_editor.pkgd.min.js') }}"></script> --}}
		{{-- <script type="text/javascript" src="{{ asset('assets/node_modules/froala-editor/js/languages/pt_br.js') }}"></script> --}}
		{{-- <script src="{{ asset('assets/scripts/app/clinica/core.js') }}"></script> --}}
		{{-- <script src="{{ asset('assets/js/clinica/js/pacientes/form.js') }}"></script> --}}
	</x-slot:script>

</x-clinica-layout>
