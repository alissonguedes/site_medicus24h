@foreach ($pacientes as $row)
	<div id="paciente_{{ $row->id }}" class="col s12 m6 l4 card-width">
		<div class="profile-card card card-border center-align border-radius-6 z-depth-0 gradient-shadow">
			<div class="card-content white-text">

				@php

					if (!isset($row->status) || (isset($row->status) && $row->status === '0')):
					    $style = 'opacity: 0.6; filter: grayscale(1)';
					endif;

					$target = route('clinica.show-image-profile', ['paciente', $row->id]);

					$img = !getImg($target) ? (!isset($row->sexo) || (isset($row->sexo) && empty($row->sexo)) ? asset('assets/img/avatar/avatar-0.png') : ($row->sexo == 'M' ? asset('assets/img/avatar/homem.png') : asset('assets/img/avatar/mulher.png'))) : $target;
				@endphp

				<div class="center-align responsive-img circle z-depth-4" style="position: relative; margin: auto; overflow: hidden; width: 100px; height: 100px;">
					<img src="{{ $img }}" class="" style="width: 100%;" alt="">
				</div>

				<h5 class="title white-text mt-0 uppercase" style="max-width: 100%">{{ $row->nome ?? null }}</h5>

				@if (isset($row->status) && $row->status === 'Inativo')
					<div class="btn btn-floating z-depth-0 transparent" data-tooltip="Paciente inativo" style="position: absolute; right: 18px; top: 18px; font-size: 24px;">
						<i class="material-symbols-outlined teal-text" style="font-size: inherit; font-weight: 400; color: #fff !important;">lock</i>
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
						<h5 class="icon-background gradient-45deg-deep-orange-orange pointer circle white-text z-depth-3 mx-auto waves-effect waves-light" data-tooltip="Prontuário">
							<i class="material-symbols-outlined">assignment_ind</i>
						</h5>
					</div>
					<div class="col s4">
						<h5 class="icon-background gradient-45deg-deep-orange-orange pointer circle white-text z-depth-3 mx-auto waves-effect waves-light" data-tooltip="Agendamento" data-target="agendamento" data-trigger="form-sidenav">
							<i class="material-symbols-outlined">event</i>
						</h5>
					</div>
					<div class="col s4">
						<h5 class="icon-background gradient-45deg-deep-orange-orange edit pointer circle white-text z-depth-3 mx-auto waves-effect waves-light" data-href="{{ route('clinica.pacientes.edit', $row->id) }}" data-tooltip="Editar" data-trigger="form" data-target="main-form">
							<i class="material-symbols-outlined">edit</i>
						</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
@endforeach
